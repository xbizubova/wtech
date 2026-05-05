<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Basket;

class OrderController extends Controller
{
    // Krok 1 — Customer Information
    public function customerInfo()
    {
        $user = Auth::user();
        return view('order.customer-info', compact('user'));
    }

    public function saveCustomerInfo(Request $request)
    {
        $request->validate([
            'name'         => 'required|string',
            'last_name'    => 'nullable|string',
            'email'        => 'required|email',
            'phone_number' => 'nullable|string',
            'address'      => 'required|string',
            'city'         => 'required|string',
            'state'        => 'required|string',
        ]);

        session(['order_customer' => $request->only([
            'name', 'last_name', 'email',
            'phone_number', 'address', 'city', 'state'
        ])]);

        return redirect()->route('order.shipping');
    }

    // Krok 2 — Shipping Method
    public function shipping()
    {
        return view('order.shipping');
    }

    public function saveShipping(Request $request)
    {
        $request->validate(['shipping_method' => 'required|string']);

        $prices = [
            'home'         => 2.99,
            'pickup-point' => 1.99,
            'pickup-store' => 0.00,
        ];

        session([
            'order_shipping' => $request->shipping_method,
            'order_shipping_price' => $prices[$request->shipping_method] ?? 0,
        ]);

        return redirect()->route('order.payment');
    }

    // Krok 3 — Payment Method
    public function payment()
    {
        return view('order.payment');
    }

    public function savePayment(Request $request)
    {
        $request->validate(['payment_method' => 'required|string']);
        session(['order_payment' => $request->payment_method]);
        return redirect()->route('order.summary');
    }

    // Krok 4 — Order Summary
    public function summary()
    {
        $sessionBasket = session('basket', []);

        if (Auth::check()) {
            $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);
            $items = $basket->books;
            $subtotal = $items->sum(fn($b) => $b->price * $b->pivot->amount);
        } else {
            $items = collect($sessionBasket)->map(function ($item) {
                return (object) $item;
            });
            $subtotal = $items->sum(fn($i) => $i->price * $i->quantity);
        }

        $customer = session('order_customer', []);
        $shipping = session('order_shipping', '');
        $shippingPrice = session('order_shipping_price', 0);
        $payment = session('order_payment', '');
        $total = $subtotal + $shippingPrice;

        return view('order.summary', compact(
            'items', 'customer', 'shipping',
            'shippingPrice', 'payment', 'subtotal', 'total'
        ));
    }

    // Krok 5 — Potvrdiť objednávku
    public function confirm()
    {
        $shippingPrice = session('order_shipping_price', 0);

        if (Auth::check()) {
            $basket = Basket::firstOrCreate(['customer_id' => Auth::id()]);
            $items = $basket->books;
            $subtotal = $items->sum(fn($b) => $b->price * $b->pivot->amount);
            $total = $subtotal + $shippingPrice;

            $order = Order::create([
                'customer_id'     => Auth::id(),
                'status'          => 'pending',
                'total_price'     => $total,
                'shipping_method' => session('order_shipping'),
                'shipping_price'  => $shippingPrice,
                'payment_method'  => session('order_payment'),
            ]);

            foreach ($items as $book) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'book_id'  => $book->book_id,
                    'amount'   => $book->pivot->amount,
                    'price'    => $book->price,
                ]);
                $book->decrement('amount', $book->pivot->amount);
            }

            $basket->books()->detach();
        } else {
            $sessionBasket = session('basket', []);
            $subtotal = collect($sessionBasket)->sum(fn($i) => $i['price'] * $i['quantity']);
            $total = $subtotal + $shippingPrice;

            $order = Order::create([
                'customer_id'     => null,
                'status'          => 'pending',
                'total_price'     => $total,
                'shipping_method' => session('order_shipping'),
                'shipping_price'  => $shippingPrice,
                'payment_method'  => session('order_payment'),
            ]);

            foreach ($sessionBasket as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'book_id'  => $item['book_id'],
                    'amount'   => $item['quantity'],
                    'price'    => $item['price'],
                ]);
                \App\Models\Book::find($item['book_id'])?->decrement('amount', $item['quantity']);
            }

            session()->forget('basket');
        }

        session()->forget(['order_customer', 'order_shipping', 'order_shipping_price', 'order_payment']);

        return view('order.finish', compact('order'));
    }
}
