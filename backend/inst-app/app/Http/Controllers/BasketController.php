<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Basket;

class BasketController extends Controller
{
    // Pomocná metóda — vráti items košíka (z DB alebo session)
    private function getBasketItems(): array
    {
        if (Auth::check()) {
            $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);
            return $basket->books->map(function ($book) {
                return [
                    'book_id'  => $book->book_id,
                    'name'     => $book->name,
                    'author'   => $book->author,
                    'price'    => $book->price,
                    'photo1'   => $book->photo1,
                    'quantity' => $book->pivot->amount,
                ];
            })->toArray();
        }

        return session('basket', []);
    }

    // Zobraziť košík
    public function index()
    {
        $items = $this->getBasketItems();
        $total = collect($items)->sum(fn($i) => $i['price'] * $i['quantity']);
        return view('basket.index', compact('items', 'total'));
    }

    // Pridať knihu do košíka
    public function add(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        if (Auth::check()) {
            $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);
            $existing = $basket->books()->where('book_id', $bookId)->first();

            if ($existing) {
                $basket->books()->updateExistingPivot($bookId, [
                    'amount' => $existing->pivot->amount + 1,
                ]);
            } else {
                $basket->books()->attach($bookId, ['amount' => 1]);
            }
        } else {
            $basket = session('basket', []);
            $found = false;

            foreach ($basket as &$item) {
                if ($item['book_id'] == $bookId) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $basket[] = [
                    'book_id'  => $book->book_id,
                    'name'     => $book->name,
                    'author'   => $book->author,
                    'price'    => $book->price,
                    'photo1'   => $book->photo1,
                    'quantity' => 1,
                ];
            }

            session(['basket' => $basket]);
        }

        return back()->with('success', 'Kniha pridaná do košíka.');
    }

    // Aktualizovať množstvo
    public function update(Request $request, $bookId)
    {
        $quantity = max(1, (int) $request->quantity);

        if (Auth::check()) {
            $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);
            $basket->books()->updateExistingPivot($bookId, ['amount' => $quantity]);
        } else {
            $basket = session('basket', []);
            foreach ($basket as &$item) {
                if ($item['book_id'] == $bookId) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            session(['basket' => $basket]);
        }

        return back();
    }

    // Odstrániť knihu
    public function remove($bookId)
    {
        if (Auth::check()) {
            $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);
            $basket->books()->detach($bookId);
        } else {
            $basket = session('basket', []);
            $basket = array_filter($basket, fn($i) => $i['book_id'] != $bookId);
            session(['basket' => array_values($basket)]);
        }

        return back();
    }

    // Zlúčiť session košík s DB po prihlásení
    public static function mergeSessionBasket()
    {
        if (!Auth::check()) return;

        $sessionBasket = session('basket', []);
        if (empty($sessionBasket)) return;

        $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);

        foreach ($sessionBasket as $item) {
            $existing = $basket->books()->where('book_id', $item['book_id'])->first();
            if ($existing) {
                $basket->books()->updateExistingPivot($item['book_id'], [
                    'amount' => $existing->pivot->amount + $item['quantity'],
                ]);
            } else {
                $basket->books()->attach($item['book_id'], ['amount' => $item['quantity']]);
            }
        }

        session()->forget('basket');
    }
}

