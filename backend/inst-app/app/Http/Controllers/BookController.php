<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Book::with(['categories', 'images', 'sale'])->where('is_hidden', false);

        // Filtrovanie podľa booktok
        if ($request->filled('is_booktok')) {
            $query->where('is_booktok', true);
        }

        // Filtrovanie podľa recommended
        if ($request->filled('is_recommended')) {
            $query->where('is_recommended', true);
        }

        //Filtrovanie podľa on sale
        if ($request->has('on_sale') && $request->on_sale == '1') {
            $today = now()->toDateString();
            $query->whereHas('sale', function($q) use ($today) {
                $q->where(function($q) use ($today) {
                    $q->whereNull('start_sale')->orWhere('start_sale', '<=', $today);
                })->where(function($q) use ($today) {
                    $q->whereNull('end_sale')->orWhere('end_sale', '>=', $today);
                });
            });
        }
        // Filtrovanie podľa new releases
        if ($request->filled('new_releases')) {
            $query->where('release_date', '>=', now()->subYear(5));
        }

        // Filtrovanie podľa jazyka
        if ($request->filled('language')) {
            $query->whereIn('language', $request->language);
        }

        // Filtrovanie podľa kategórie/typu
        if ($request->filled('type')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->whereIn('categories.category_id', $request->type);
            });
        }

        // Filtrovanie podľa ceny
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Vyhľadávanie
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        // Zoraďovanie
        $query->leftJoin('book_sales', function($join) {
            $today = now()->toDateString();
            $join->on('book_sales.book_id', '=', 'books.book_id')
                ->where(function($q) use ($today) {
                    $q->whereNull('book_sales.start_sale')
                        ->orWhere('book_sales.start_sale', '<=', $today);
                })
                ->where(function($q) use ($today) {
                    $q->whereNull('book_sales.end_sale')
                        ->orWhere('book_sales.end_sale', '>=', $today);
                });
        })
            ->selectRaw('books.*, COALESCE(books.price * book_sales.price_modifier, books.price) as computed_price');

        $sort = $request->get('sort', 'price_asc');
        match($sort) {
            'price_asc'  => $query->orderBy('computed_price', 'asc'),
            'price_desc' => $query->orderBy('computed_price', 'desc'),
            'name_asc'   => $query->orderBy('books.name', 'asc'),
            'name_desc'  => $query->orderBy('books.name', 'desc'),
            default      => $query->orderBy('computed_price', 'asc'),
        };

        // Stránkovanie
        $books = $query->paginate(6)->withQueryString();
        $minPrice = Book::min('price');
        $maxPrice = Book::max('price');

        return view('books.index', compact('books', 'categories', 'minPrice', 'maxPrice'));
    }

    public function show($id)
    {
        $book = Book::with(['categories', 'images', 'sale'])->findOrFail($id);
        return view('books.show', compact('book'));
    }
    public function home()
    {
        $recommended = Book::with('images')->where('is_recommended', true)->limit(2)->get();
        $trending = Book::with('images')->where('is_booktok', true)->limit(4)->get();
        return view('home', compact('recommended', 'trending'));
    }
}
