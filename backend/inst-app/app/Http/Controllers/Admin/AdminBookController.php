<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\BookSale;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Book::with(['categories', 'images', 'sale']);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

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

        if ($request->has('is_booktok') && $request->is_booktok == '1') {
            $query->where('is_booktok', true);
        }

        if ($request->has('is_recommended') && $request->is_recommended == '1') {
            $query->where('is_recommended', true);
        }

        if ($request->has('new_releases') && $request->new_releases == '1') {
            $query->where('release_date', '>=', now()->subYear());
        }

        if ($request->filled('language')) {
            $query->whereIn('language', $request->language);
        }

        if ($request->filled('type')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->whereIn('categories.category_id', $request->type);
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $sort = $request->get('sort', 'price_asc');
        match($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc'   => $query->orderBy('name', 'asc'),
            'name_desc'  => $query->orderBy('name', 'desc'),
            default      => $query->orderBy('price', 'asc'),
        };

        $books = $query->paginate(6)->withQueryString();
        return view('admin.books.index', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::with(['categories', 'images', 'sale'])->findOrFail($id);
        $categories = Category::all();
        return view('admin.books.show', compact('book', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string',
            'author'       => 'required|string',
            'price'        => 'required|numeric',
            'language'     => 'required|string',
            'detail'       => 'nullable|string',
            'rating'       => 'nullable|integer|min:1|max:5',
            'amount'       => 'required|integer',
            'release_date' => 'nullable|date|before_or_equal:today',
            'new_images'   => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,jpg,png,webp|max:5120',
            // sale polia
            'discount'     => 'nullable|integer|min:0|max:100',
            'start_sale'   => 'nullable|date',
            'end_sale'     => 'nullable|date',
        ]);

        //$data['is_on_sale']     = $request->has('is_on_sale');
        $data['is_booktok']     = $request->has('is_booktok');
        $data['is_recommended'] = $request->has('is_recommended');
        $data['is_hidden']      = false;

        // Vyberieme sale dáta pred vytvorením knihy
        $discount   = $data['discount'] ?? null;
        $startSale  = $data['start_sale'] ?? null;
        $endSale    = $data['end_sale'] ?? null;
        unset($data['discount'], $data['start_sale'], $data['end_sale']);

        $book = Book::create($data);
        $book->refresh();

        if ($request->filled('categories')) {
            $book->categories()->attach($request->categories);
        }

        // Uložíme obrázky
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $file) {
                $originalName = $file->getClientOriginalName();

                // Ak súbor ešte neexistuje, skopíruj ho
                if (!file_exists(public_path('pictures/' . $originalName))) {
                    $file->move(public_path('pictures'), $originalName);
                }

                \App\Models\BookImage::create([
                    'book_id'  => $book->book_id,
                    'filename' => $originalName,
                    'order'    => $index + 1,
                ]);
            }
        }

        // Uložíme zľavu ak je zadaná
        if ($discount && $discount > 0) {
            BookSale::create([
                'book_id'        => $book->book_id,
                'price_modifier' => round(1 - $discount / 100, 4),
                'start_sale'     => $startSale,
                'end_sale'       => $endSale,
            ]);
        }

        return redirect()->route('admin.books.index')->with('success', 'Kniha bola pridaná.');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'name'         => 'required|string',
            'author'       => 'required|string',
            'price'        => 'required|numeric',
            'language'     => 'required|string',
            'detail'       => 'nullable|string',
            'rating'       => 'nullable|integer|min:1|max:5',
            'amount'       => 'required|integer',
            'release_date' => 'nullable|date|before_or_equal:today',
            'new_images'   => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,jpg,png,webp|max:5120',
            // sale polia
            'discount'     => 'nullable|integer|min:0|max:100',
            'start_sale'   => 'nullable|date',
            'end_sale'     => 'nullable|date',
        ]);

        //$data['is_on_sale']     = $request->has('is_on_sale');
        $data['is_booktok']     = $request->has('is_booktok');
        $data['is_recommended'] = $request->has('is_recommended');

        // Vyberieme sale dáta pred updateom knihy
        $discount  = $data['discount'] ?? null;
        $startSale = $data['start_sale'] ?? null;
        $endSale   = $data['end_sale'] ?? null;
        unset($data['discount'], $data['start_sale'], $data['end_sale']);

        $book->update($data);

        if ($request->filled('categories')) {
            $book->categories()->sync($request->categories);
        }

        // Uložíme nové obrázky
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $file) {
                $originalName = $file->getClientOriginalName();

                // Ak súbor ešte neexistuje, skopíruj ho
                if (!file_exists(public_path('pictures/' . $originalName))) {
                    $file->move(public_path('pictures'), $originalName);
                }

                \App\Models\BookImage::create([
                    'book_id'  => $book->book_id,
                    'filename' => $originalName,
                    'order'    => $index + 1,
                ]);
            }
        }

        // Aktualizujeme zľavu
        if ($discount && $discount > 0) {
            BookSale::updateOrCreate(
                ['book_id' => $book->book_id],
                [
                    'price_modifier' => round(1 - $discount / 100, 4),
                    'start_sale'     => $startSale,
                    'end_sale'       => $endSale,
                ]
            );
        } else {
            // Ak je discount 0 alebo prázdny, zmažeme zľavu
            BookSale::where('book_id', $book->book_id)->delete();
        }

        return redirect()->route('admin.books.show', $id)->with('success', 'Kniha bola upravená.');
    }

    public function restock(Request $request, $id)
    {
        $request->validate(['restock_amount' => 'required|integer|min:1']);
        $book = Book::findOrFail($id);
        $book->increment('amount', $request->restock_amount);
        return redirect()->route('admin.books.show', $id)->with('success', 'Sklad bol doplnený.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->is_hidden = true;
        $book->save();
        return redirect()->route('admin.books.index')->with('success', 'Kniha bola skrytá.');
    }

    public function deleteImage($imageId)
    {
        $image = \App\Models\BookImage::findOrFail($imageId);
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function uploadImages(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'new_images.*' => 'required|image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $file) {
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();
                $file->move(public_path('pictures'), $filename);
                \App\Models\BookImage::create([
                    'book_id' => $book->book_id,
                    'filename' => $filename,
                    'order'   => $book->images()->max('order') + $index + 1,
                ]);
            }
        }

        return back()->with('success', 'Obrázky boli pridané.');
    }

    public function restore($id)
    {
        $book = Book::findOrFail($id);
        $book->is_hidden = false;
        $book->save();
        return redirect()->route('admin.books.show', $id)->with('success', 'Kniha bola obnovená.');
    }
}
