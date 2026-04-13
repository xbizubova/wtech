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
        $query = Book::with('categories');

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

        // Zoraďovanie
        $sort = $request->get('sort', 'price_asc');
        match($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc'   => $query->orderBy('name', 'asc'),
            'name_desc'  => $query->orderBy('name', 'desc'),
            default      => $query->orderBy('price', 'asc'),
        };

        // Stránkovanie
        $books = $query->paginate(6)->withQueryString();

        return view('books.index', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        return view('books.show', compact('book'));
    }
}
