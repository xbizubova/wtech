<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = collect();
        //$orders = $user->orders()->with('books')->get() ?? collect();
        return view('account', compact('user', 'orders'));
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
