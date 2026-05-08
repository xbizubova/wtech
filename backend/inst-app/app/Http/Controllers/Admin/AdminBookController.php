<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Book::with('categories');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('on_sale') && $request->on_sale == '1') {
            $query->where('is_on_sale', true);
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
        $book = Book::with('categories')->findOrFail($id);
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
            'name'           => 'required|string',
            'author'         => 'required|string',
            'price'          => 'required|numeric',
            'original_price' => 'nullable|numeric',
            'language'       => 'required|string',
            'detail'         => 'nullable|string',
            'rating'         => 'nullable|integer|min:1|max:5',
            'amount'         => 'required|integer',
            'release_date'   => 'nullable|date',
            'photo1'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'photo2'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'new_images'   => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        // Checkboxy — ak sú zaškrtnuté, has() vráti true, inak false
        $data['is_on_sale']     = $request->has('is_on_sale');
        $data['is_booktok']     = $request->has('is_booktok');
        $data['is_recommended'] = $request->has('is_recommended');
        $data['is_hidden']      = false; // nová kniha je vždy viditeľná

        if ($request->hasFile('photo1')) {
            $data['photo1'] = $request->file('photo1')->getClientOriginalName();
            $request->file('photo1')->move(public_path('pictures'), $data['photo1']);
        }

        if ($request->hasFile('photo2')) {
            $data['photo2'] = $request->file('photo2')->getClientOriginalName();
            $request->file('photo2')->move(public_path('pictures'), $data['photo2']);
        }

        $book = Book::create($data);

        if ($request->filled('categories')) {
            $book->categories()->attach($request->categories);
        }
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('pictures'), $filename);

                // prvý obrázok nastav aj ako photo1
                if ($index === 0) {
                    $book->photo1 = $filename;
                    $book->save();
                }

                \App\Models\BookImage::create([
                    'book_id'  => $book->book_id,
                    'filename' => $filename,
                    'order'    => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.books.index')->with('success', 'Kniha bola pridaná.');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'name'          => 'required|string',
            'author'        => 'required|string',
            'price'         => 'required|numeric',
            'original_price'=> 'nullable|numeric',
            'language'      => 'required|string',
            'detail'        => 'nullable|string',
            'rating'        => 'nullable|integer|min:1|max:5',
            'amount'        => 'required|integer',
            'release_date'  => 'nullable|date',
            'new_images'    => 'nullable|array',
            'new_images.*'  => 'image|mimes:jpeg,jpg,png,webp|max:5120',
        ]);

        if ($request->hasFile('photo1')) {
            $data['photo1'] = $request->file('photo1')->getClientOriginalName();
            $request->file('photo1')->move(public_path('pictures'), $data['photo1']);
        }

        if ($request->hasFile('photo2')) {
            $data['photo2'] = $request->file('photo2')->getClientOriginalName();
            $request->file('photo2')->move(public_path('pictures'), $data['photo2']);
        }

        $data['is_on_sale']     = $request->has('is_on_sale');
        $data['is_booktok']     = $request->has('is_booktok');
        $data['is_recommended'] = $request->has('is_recommended');

        $book->update($data);

        if ($request->filled('categories')) {
            $book->categories()->sync($request->categories);
        }


        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('pictures'), $filename);
                \App\Models\BookImage::create([
                    'book_id'  => $book->book_id,
                    'filename' => $filename,
                    'order'    => $book->images()->max('order') + $index + 1,
                ]);
            }
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
        // Namiesto vymazania len skryje knihu
        $book = Book::findOrFail($id);
        $book->is_hidden = true;
        $book->save();
        return redirect()->route('admin.books.index')->with('success', 'Kniha bola skrytá.');
    }

    public function deleteImage($imageId)
    {
        $image = \App\Models\BookImage::findOrFail($imageId);
        // voliteľne: unlink(public_path('pictures/' . $image->filename));
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
            $first = $book->images->isEmpty();
            foreach ($request->file('new_images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('pictures'), $filename);
                \App\Models\BookImage::create([
                    'book_id'    => $book->book_id,
                    'filename'   => $filename,
                    'is_primary' => $first,
                ]);
                if ($first) {
                    $book->update(['photo1' => $filename]);
                    $first = false;
                }
            }
        }

        return back()->with('success', 'Obrázky boli pridané.');
    }

    // Obnoviť skrytú knihu
    public function restore($id)
    {
        $book = Book::findOrFail($id);
        $book->is_hidden = false;
        $book->save();
        return redirect()->route('admin.books.show', $id)->with('success', 'Kniha bola obnovená.');
    }
}
