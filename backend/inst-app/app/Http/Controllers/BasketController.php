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
            return $basket->books()->with('images')->get()->map(function ($book) {
                $image = $book->images->first();
                return [
                    'book_id'  => $book->book_id,
                    'name'     => $book->name,
                    'author'   => $book->author,
                    'price'    => $book->price,
                    'photo1'   => $image?->filename,
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
        $book = Book::with('images')->findOrFail($bookId);
        $quantity = max(1, (int) $request->quantity);

        // Skontroluj dostupné množstvo
        if (Auth::check()) {
            $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);
            $existing = $basket->books()->wherePivot('book_id', $bookId)->first();
            $currentInBasket = $existing ? $existing->pivot->amount : 0;

            if ($currentInBasket + $quantity > $book->amount) {
                return back()->with('error', 'Not enough books in Stock. Amount in Stock: ' . ($book->amount - $currentInBasket));
            }

            if ($existing) {
                $basket->books()->updateExistingPivot($bookId, [
                    'amount' => $existing->pivot->amount + $quantity,
                ]);
            } else {
                $basket->books()->attach($bookId, ['amount' => $quantity]);
            }
        } else {
            $basket = session('basket', []);
            $found = false;
            $currentInBasket = 0;

            foreach ($basket as $item) {
                if ($item['book_id'] == $bookId) {
                    $currentInBasket = $item['quantity'];
                    $found = true;
                    break;
                }
            }

            if ($currentInBasket + $quantity > $book->amount) {
                return back()->with('error', 'Not enough books in Stock. Amount in Stock: ' . ($book->amount - $currentInBasket));
            }

            if ($found) {
                foreach ($basket as &$item) {
                    if ($item['book_id'] == $bookId) {
                        $item['quantity'] += $quantity;
                        break;
                    }
                }
            } else {
                $basket[] = [
                    'book_id'  => $book->book_id,
                    'name'     => $book->name,
                    'author'   => $book->author,
                    'price'    => $book->price,
                    'photo1'   => $book->images->first()?->filename,
                    'quantity' => $quantity,
                ];
            }

            session(['basket' => $basket]);
        }
        return back()->with('success', 'Book added to basket successfully!.');
    }

    // Aktualizovať množstvo
    public function update(Request $request, $bookId)
    {
        $quantity = max(1, (int) $request->quantity);
        $book = Book::findOrFail($bookId);

        // Skontroluj dostupné množstvo
        if ($quantity > $book->amount) {
            return back()->with('error', 'Not enough books in Stock. Amount in Stock: ' . $book->amount);
        }

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

        return back()->with('success', 'Basket updated successfully!.');
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
            $existing = $basket->books()->wherePivot('book_id', $item['book_id'])->first();
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

