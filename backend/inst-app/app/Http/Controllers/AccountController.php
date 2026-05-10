<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items.book')->latest()->get();

        // Zobraz unikátne knihy naprieč všetkými objednávkami
        $purchasedBooks = $orders->flatMap(fn($order) => $order->items)
            ->unique('book_id');

        return view('account', compact('user', 'orders', 'purchasedBooks'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'         => 'required|string',
            'last_name'    => 'nullable|string',
            'email'        => 'required|email',
            'phone_number' => 'nullable|string',
            'address'      => 'nullable|string',
            'city'         => 'nullable|string',
            'state'        => 'nullable|string',
        ]);

        $user->update($request->only([
            'name', 'last_name', 'email',
            'phone_number', 'address', 'city', 'state'
        ]));

        return back()->with('success', 'New informations saved!');
    }
}
