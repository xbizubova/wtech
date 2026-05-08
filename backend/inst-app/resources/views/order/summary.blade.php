<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Order Summary</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        <a href="{{ route('account') }}" class="btn-login">ACCOUNT</a>
    </nav>
</header>

<main>
    <div class="shipping-container summary-container">
        <h1 class="shipping-title">Order Summary</h1>

        <div class="summary-section">
            <p class="summary-section-label">Your Books</p>
            @foreach($items as $book)
                @php
                    $qty = isset($book->pivot) ? $book->pivot->amount : ($book->quantity ?? 1);
                    $photo = isset($book->pivot) ? $book->photo1 : ($book->photo1 ?? null);
                    $name = isset($book->pivot) ? $book->name : ($book->name ?? '');
                    $author = isset($book->pivot) ? $book->author : ($book->author ?? '');
                    $price = isset($book->pivot) ? $book->price : ($book->price ?? 0);
                @endphp
                <div class="summary-book-item">
                    @if($photo)
                        <img class="item-cover" src="{{ asset('pictures/' . $photo) }}" alt="{{ $name }}">
                    @else
                        <div class="item-cover"></div>
                    @endif
                    <div class="summary-book-info">
                        <p class="summary-book-title">{{ $name }}</p>
                        <p class="summary-book-author">{{ $author }}</p>
                        <p style="font-size:13px; color:gray;">Qty: {{ $qty }}</p>
                    </div>
                    <span class="summary-book-price">{{ number_format($price * $qty, 2) }} €</span>
                </div>
            @endforeach
        </div>

        <div class="summary-section">
            <p class="summary-section-label">Delivery & Payment</p>
            <div class="summary-detail-row">
                <div class="summary-detail-left">
                    <span class="summary-detail-label">Shipping</span>
                    <span class="summary-detail-value">{{ $shipping }}</span>
                </div>
                <span class="summary-detail-price">{{ number_format($shippingPrice, 2) }} €</span>
            </div>
            <div class="summary-detail-row">
                <div class="summary-detail-left">
                    <span class="summary-detail-label">Payment</span>
                    <span class="summary-detail-value">{{ $payment }}</span>
                </div>
                <span class="summary-detail-price">0,00 €</span>
            </div>
        </div>

        <div class="summary-section">
            <p class="summary-section-label">Delivery Address</p>
            <div class="summary-address-card">
                <div class="summary-address-row">
                    <span>{{ $customer['name'] ?? '' }} {{ $customer['last_name'] ?? '' }}</span>
                </div>
                <div class="summary-address-row">
                    <span>{{ $customer['address'] ?? '' }}, {{ $customer['city'] ?? '' }}, {{ $customer['state'] ?? '' }}</span>
                </div>
            </div>
        </div>

        <div class="summary-total-bar">
            <span class="summary-total-label">Total</span>
            <span class="summary-total-amount">{{ number_format($total, 2) }} €</span>
        </div>
    </div>

    <div class="step-wrapper">
        <form method="POST" action="{{ route('order.confirm') }}">
            @csrf
            <button type="submit" class="btn-step">
                Confirm Order
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        </form>
    </div>
</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo">LEXEM</a>
            <p class="footer-tagline">Not just selling books, we are creating our own fantasy.</p>
        </div>
        <div class="footer-col">
            <h4>Contact information</h4>
            <ul>
                <li>Bratislava, Dúhová 17</li>
                <li>support@lexem.sk</li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>
