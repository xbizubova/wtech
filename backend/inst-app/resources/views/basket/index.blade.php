<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Your Basket</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        @auth
            <a href="{{ route('logout') }}" class="btn-login"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit()">LOG OUT</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
        @else
            <a href="{{ route('login') }}" class="btn-login">LOG IN</a>
        @endauth
        <a href="{{ url('/basket') }}" class="btn-cart">
            <svg class="cart-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 01-8 0"/>
            </svg>
        </a>
    </nav>
    <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</header>

<nav class="mobile-nav" id="mobileNav">
    @auth
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit()">Log Out</a>
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
    @else
        <a href="{{ route('login') }}">Log In</a>
    @endauth
    <a href="{{ route('home') }}">Home</a>
</nav>

<main>
    <div class="basket-container">

        <div class="basket-header">
            <h1 class="basket-title">Your Basket</h1>
        </div>

        <div class="basket-items" id="basketItems">

            @forelse($items as $item)
                <div class="basket-item" data-id="{{ $item['book_id'] }}" data-price="{{ $item['price'] }}">

                    <img class="item-cover"
                         src="{{ asset('pictures/' . $item['photo1']) }}"
                         alt="{{ $item['name'] }}">

                    <div class="item-info">
                        <p class="item-title">{{ $item['name'] }}</p>
                        <p class="item-author">{{ $item['author'] }}</p>
                    </div>

                    <div class="item-controls">
                        <div class="qty-stepper">
                            <form method="POST" action="{{ url('/basket/update/' . $item['book_id']) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}">
                                <button type="submit" class="qty-btn minus" aria-label="Decrease">−</button>
                            </form>

                            <form method="POST" action="{{ url('/basket/update/' . $item['book_id']) }}">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"
                                       class="qty-value" style="width:48px; text-align:center; border:none; background:transparent;"
                                       onchange="this.form.submit()">
                            </form>

                            <form method="POST" action="{{ url('/basket/update/' . $item['book_id']) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                <button type="submit" class="qty-btn plus" aria-label="Increase">+</button>
                            </form>
                        </div>

                        <form method="POST" action="{{ url('/basket/remove/' . $item['book_id']) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" aria-label="Remove item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-1 14H6L5 6"/>
                                    <path d="M10 11v6M14 11v6"/>
                                    <path d="M9 6V4h6v2"/>
                                </svg>
                            </button>
                        </form>

                        <span class="item-price">{{ number_format($item['price'] * $item['quantity'], 2, ',', '') }} €</span>
                    </div>

                </div>
            @empty
                <div class="basket-empty" id="emptyState">
                    <p>Your basket is empty</p>
                </div>
            @endforelse

        </div>

        @if(count($items) > 0)
            <div class="basket-summary" id="basketSummary">
                <span class="summary-label">Total</span>
                <span class="summary-total">{{ number_format($total, 2, ',', '') }} €</span>
            </div>
        @endif

    </div>

    @if(count($items) > 0)
        <div class="step-wrapper">
            <a href="{{ url('/checkout/information') }}" class="btn-step">
                Customer Info
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
        </div>
    @endif

</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo">LEXEM</a>
            <p class="footer-tagline">Not just selling books, we are creating our own fantasy.</p>
            <a href="https://www.instagram.com/_nina.anin_/" class="footer-social">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/>
                </svg>
            </a>
            <a href="https://www.instagram.com/alexandra_aghova/" class="footer-social">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/>
                </svg>
            </a>
        </div>
        <div class="footer-col">
            <h4>Categories</h4>
            <ul>
                <li><a href="{{ route('books.index') }}">Books</a></li>
                <li><a href="{{ route('books.index', ['on_sale' => 1]) }}">Sale</a></li>
                <li><a href="{{ route('books.index') }}">New releases</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contact information</h4>
            <ul>
                <li>Bratislava, Dúhová 17</li>
                <li>support@lexem.sk</li>
                <li>+42112345678</li>
            </ul>
        </div>
    </div>
</footer>

<script>
    const hamburger = document.getElementById('hamburger');
    const mobileNav = document.getElementById('mobileNav');
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        mobileNav.classList.toggle('open');
    });
</script>

</body>
</html>
