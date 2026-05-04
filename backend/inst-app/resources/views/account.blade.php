<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        <a href="{{ route('logout') }}" class="btn-login"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit()">LOG OUT</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
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
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit()">LOG OUT</a>
    <a href="{{ url('/basket') }}">Basket</a>
</nav>

<main>
    <div class="account-container">
        <h1 class="account-title">ACCOUNT INFORMATION</h1>

        @if(session('success'))
            <p style="color:green; text-align:center; margin-bottom:16px;">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('account.update') }}">
            @csrf
            <div class="account-form">
                <div class="form-grid">
                    <div class="form-col">
                        <div class="field-group">
                            <label class="field-label">Email</label>
                            <input type="email" class="field-input" name="email"
                                   value="{{ $user->email }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">First name</label>
                            <input type="text" class="field-input" name="name"
                                   value="{{ $user->name }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">Surname</label>
                            <input type="text" class="field-input" name="last_name"
                                   value="{{ $user->last_name }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">Phone number</label>
                            <input type="tel" class="field-input" name="phone_number"
                                   value="{{ $user->phone_number }}">
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="field-group">
                            <label class="field-label">Street and house number</label>
                            <input type="text" class="field-input" name="address"
                                   value="{{ $user->address }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">City</label>
                            <input type="text" class="field-input" name="city"
                                   value="{{ $user->city }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">State</label>
                            <input type="text" class="field-input" name="state"
                                   value="{{ $user->state }}">
                        </div>
                        <div class="field-group">
                            <button type="submit" class="field-group-btn">CHANGE INFORMATION</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="book-history">
            <h1 class="history">BOOKS YOU PURCHASED</h1>
            <div class="order-history">
                <div class="books-grid-4">
                    @forelse($orders as $order)
                        @foreach($order->items as $item)
                            <a href="{{ route('books.show', $item->book->book_id) }}" class="book-card">
                                @if($item->book->photo1)
                                    <img class="book-cover" src="{{ asset('pictures/' . $item->book->photo1) }}" alt="{{ $item->book->name }}">
                                @else
                                    <div class="book-cover"></div>
                                @endif
                                <p class="book-title">{{ $item->book->name }}</p>
                            </a>
                        @endforeach
                    @empty
                        <p>No orders yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo">LEXEM</a>
            <p class="footer-tagline">Not just selling books, we are creating our own fantasy.</p>
        </div>
        <div class="footer-col">
            <h4>Categories</h4>
            <ul>
                <li><a href="{{ route('books.index') }}">Books</a></li>
                <li><a href="{{ route('books.index', ['on_sale' => 1]) }}">Sale</a></li>
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
