<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Blade komentár. Tu dávame názov knihy do titulku stránky --}}
    {{-- {{ }} znamená "vypíš premennú" --}}
    <title>LEXEM — {{ $book->name }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

    {{-- asset() hľadá súbor v priečinku "public/" --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    {{-- route('home') vygeneruje URL na hlavnú stránku --}}
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
    <a href="{{ route('login') }}">Log OUT</a>
    <a href="{{ url('/basket') }}">Basket</a>
</nav>

<main>
    <div class="book-detail">

        <div class="book-detail-cover">
            <img src="{{ asset('pictures/' . $book->photo1) }}" alt="Book cover">
        </div>

        <div class="book-detail-info">
            <h1 class="book-detail-title">{{ $book->name }}</h1>
            <p class="book-detail-author">{{ $book->author }}</p>
            <div class="description-wrapper">
                <p class="book-detail-description">
                    {{ $book->detail ?? 'Popis nie je k dispozícii.' }}
                </p>
            </div>
            <button class="btn-show-more" id="btnShowMore">Show more</button>
        </div>

        <div class="book-detail-extras">
            @if($book->is_on_sale && $book->original_price)
                <div class="book-detail-price">
                    <span class="price-original">{{ number_format($book->original_price, 2) }}€</span>
                    <span class="price-sale">{{ number_format($book->price, 2) }}€</span>
                </div>
            @else
                <div class="book-detail-price">{{ number_format($book->price, 2) }}€</div>
            @endif

            <div class="book-detail-language">{{ $book->language }}</div>

            <div class="book-detail-add">
                <form id="basketForm" method="POST" action="{{ route('basket.add', $book->book_id) }}">
                    @csrf
                    <input type="hidden" name="quantity" id="qtyHidden" value="1">
                    <button type="submit" class="btn-step" id="btnAddToBasket">ADD TO BASKET</button>
                </form>
                <div class="qty-stepper" id="qtyStepper" style="display:none;">
                    <button type="button" class="qty-btn" id="qtyMinus">−</button>
                    <input type="number" class="qty-value" id="qtyDisplay" value="1" min="1" max="{{ $book->amount }}">
                    <button type="button" class="qty-btn" id="qtyPlus">+</button>
                </div>
            </div>
        </div>

        <div class="rating">
            <p class="rating-label">RATING</p>
            <div class="stars-client">
                <h1 class="rating-value">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $book->rating ? '★' : '☆' }}
                    @endfor
                </h1>
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
                {{-- on_sale=1 pridá filter do URL: /books?on_sale=1 --}}
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
    // Show more / Show less tlačidlo pre popis knihy
    const btn = document.getElementById('btnShowMore');
    const wrapper = document.querySelector('.description-wrapper');
    btn.addEventListener('click', () => {
        wrapper.classList.toggle('expanded');
        btn.textContent = wrapper.classList.contains('expanded') ? 'Show less' : 'Show more';
    });

    // Hamburger menu pre mobil
    const hamburger = document.getElementById('hamburger');
    const mobileNav = document.getElementById('mobileNav');
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        mobileNav.classList.toggle('open');
    });
    const stepper = document.getElementById('qtyStepper');
    const btnAdd = document.getElementById('btnAddToBasket');
    const qtyHidden = document.getElementById('qtyHidden');
    const qtyDisplay = document.getElementById('qtyDisplay');
    const qtyMinus = document.getElementById('qtyMinus');
    const qtyPlus = document.getElementById('qtyPlus');
    let qty = 1;
    const max = {{ $book->amount }};

    document.getElementById('basketForm').addEventListener('submit', function(e) {
        e.preventDefault();
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: qty })
        }).then(() => {
            btnAdd.style.display = 'none';
            stepper.style.display = 'flex';
        });
    });

    qtyMinus.addEventListener('click', () => {
        if (qty > 1) {
            qty--;
            qtyDisplay.value = qty;
            updateBasket(qty);
        }
    });

    qtyPlus.addEventListener('click', () => {
        if (qty < max) {
            qty++;
            qtyDisplay.value = qty;
            updateBasket(qty);
        }
    });

    qtyDisplay.addEventListener('change', () => {
        qty = Math.min(Math.max(1, parseInt(qtyDisplay.value) || 1), max);
        qtyDisplay.value = qty;
        updateBasket(qty);
    });

    function updateBasket(quantity) {
        fetch('{{ route('basket.update', $book->book_id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: quantity, _method: 'PATCH' })
        });
    }
</script>

</body>
</html>
