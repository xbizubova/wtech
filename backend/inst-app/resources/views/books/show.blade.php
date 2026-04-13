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
        {{-- route('login') je z auth.php ktorý máš v routes --}}
        <a href="{{ route('login') }}" class="btn-login">LOG IN</a>
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
    <a href="{{ route('login') }}">Log In</a>
    <a href="{{ url('/basket') }}">Basket</a>
</nav>

<main>
    <div class="book-detail">

        <div class="book-detail-cover">
            {{-- asset('pictures/...') hľadá obrázok v public/pictures/ --}}
            <img src="{{ asset('pictures/' . $book->photo1) }}" alt="Book cover">
        </div>

        <div class="book-detail-info">
            {{-- $book->name vypíše stĺpec "name" z databázy --}}
            <h1 class="book-detail-title">{{ $book->name }}</h1>
            <p class="book-detail-author">{{ $book->author }}</p>

            <div class="description-wrapper">
                <p class="book-detail-description">
                    {{-- ?? znamená "ak je detail null/prázdny, zobraz tento text" --}}
                    {{ $book->detail ?? 'Popis nie je k dispozícii.' }}
                </p>
            </div>
            <button class="btn-show-more" id="btnShowMore">Show more</button>
        </div>

        <div class="book-detail-extras">
            {{-- @if kontroluje podmienku — ak je kniha v zľave A má original_price --}}
            @if($book->is_on_sale && $book->original_price)
                <div class="book-detail-price">
                    {{-- number_format zaokrúhli číslo na 2 desatinné miesta --}}
                    <span class="price-original">{{ number_format($book->original_price, 2) }}€</span>
                    <span class="price-sale">{{ number_format($book->price, 2) }}€</span>
                </div>
                {{-- @else = inak (keď nie je v zľave) --}}
            @else
                <div class="book-detail-price">{{ number_format($book->price, 2) }}€</div>
            @endif

            <div class="book-detail-language">{{ $book->language }}</div>

            <div class="book-detail-add">
                {{-- $book->book_id je primárny kľúč z databázy --}}
                <a href="{{ url('/basket/add/' . $book->book_id) }}">ADD TO BASKET</a>
            </div>
        </div>

        <div class="rating">
            <p class="rating-label">RATING</p>
            <div class="stars-client">
                <h1 class="rating-value">
                    {{-- @for je slučka — opakuje sa 5 krát (pre 5 hviezdičiek) --}}
                    {{-- ak je $i menšie alebo rovné ratingu z DB, dá plnú ★, inak prázdnu ☆ --}}
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
</script>

</body>
</html>
