<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <a href="{{ route('admin.home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        <a href="#" class="btn-login">ACCOUNT</a>
        <form method="POST" action="{{ route('admin.logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="btn-login">LOG OUT</button>
        </form>
    </nav>
    <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</header>

<nav class="mobile-nav" id="mobileNav">
    <a href="#">Account</a>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">LOG OUT</button>
    </form>
</nav>

<section class="hero">
    <form method="GET" action="{{ route('admin.books.index') }}">
        <div class="search-bar">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35"/>
            </svg>
            <input type="text" name="search" placeholder="Search">
        </div>
    </form>
</section>

<main>
    <section class="recommend-section">
        <nav class="sidebar-menu">
            <p class="menu-label">Menu</p>
            <ul>
                <li><a href="{{ route('admin.books.index') }}">Books <span class="menu-arrow">›</span></a></li>
                <li><a href="{{ route('admin.books.create') }}">ADD PRODUCT <span class="menu-arrow">›</span></a></li>
            </ul>
        </nav>

        <div class="recommend-content">
            <h2 class="section-title">We Recommend</h2>
            <div class="books-grid-2">
                @foreach($recommended as $book)
                    <a href="{{ route('admin.books.show', $book->book_id) }}" class="book-card">
                        @if($book->photo1)
                            <img class="book-cover" src="{{ asset('pictures/' . $book->photo1) }}" alt="{{ $book->name }}">
                        @else
                            <div class="book-cover"></div>
                        @endif
                        <p class="book-title">{{ $book->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="trending-section">
        <div class="trending-header">
            <h2 class="section-title">Booktok Trending</h2>
        </div>
        <div class="books-grid-4">
            @foreach($trending as $book)
                <a href="{{ route('admin.books.show', $book->book_id) }}" class="book-card">
                    @if($book->photo1)
                        <img class="book-cover" src="{{ asset('pictures/' . $book->photo1) }}" alt="{{ $book->name }}">
                    @else
                        <div class="book-cover"></div>
                    @endif
                    <p class="book-title">{{ $book->name }}</p>
                </a>
            @endforeach
        </div>
    </section>
</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <a href="{{ route('admin.home') }}" class="logo">LEXEM</a>
            <p class="footer-tagline">Not just selling books, we are creating our own fantasy.</p>
        </div>
        <div class="footer-col">
            <h4>Categories</h4>
            <ul>
                <li><a href="{{ route('admin.books.index') }}">Books</a></li>
                <li><a href="{{ route('admin.books.index', ['on_sale' => 1]) }}">Sale</a></li>
                <li><a href="{{ route('admin.books.index', ['new_releases' => 1]) }}">New Releases</a></li>
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
