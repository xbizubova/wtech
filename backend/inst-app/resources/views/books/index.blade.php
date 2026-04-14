<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Kníhkupectvo</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <a href="/" class="logo">LEXEM</a>
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
    <a href="{{ route('login') }}">Log In</a>
    <a href="#">Basket</a>
</nav>

{{-- Vyhľadávanie --}}
<section class="hero">
    <form method="GET" action="{{ route('books.index') }}">
        <div class="search-bar">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.35-4.35"/>
            </svg>
            <input type="text" name="search" placeholder="Search"
                   value="{{ request('search') }}">
        </div>
    </form>
</section>

<main>
    <div class="book-layout">

        {{-- FILTRE --}}
        <form method="GET" action="{{ route('books.index') }}" id="filterForm">
            {{-- zachovaj search a sort --}}
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            @if(request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            <div class="filters">
                <div class="filter-group open">
                    <button type="button" class="filter-toggle"
                            onclick="this.parentElement.classList.toggle('open')">
                        SHOW ONLY <span class="filter-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <ul class="filter-list">
                        <li><label><input type="checkbox" name="on_sale" value="1"
                                          {{ request('on_sale') ? 'checked' : '' }}
                                          onchange="document.getElementById('filterForm').submit()"> On Sale</label></li>
                        <li><label><input type="checkbox" name="is_booktok" value="1"
                                          {{ request('is_booktok') ? 'checked' : '' }}
                                          onchange="document.getElementById('filterForm').submit()"> Booktok Trending</label></li>
                        <li><label><input type="checkbox" name="is_recommended" value="1"
                                          {{ request('is_recommended') ? 'checked' : '' }}
                                          onchange="document.getElementById('filterForm').submit()"> We Recommend</label></li>
                        <li><label><input type="checkbox" name="new_releases" value="1"
                                          {{ request('new_releases') ? 'checked' : '' }}
                                          onchange="document.getElementById('filterForm').submit()"> New Releases</label></li>
                    </ul>
                </div>

                <div class="filter-group open">
                    <button type="button" class="filter-toggle"
                            onclick="this.parentElement.classList.toggle('open')">
                        LANGUAGE <span class="filter-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <ul class="filter-list">
                        @foreach(['EN' => 'English', 'SK' => 'Slovak', 'CZ' => 'Czech'] as $code => $label)
                            <li><label>
                                    <input type="checkbox" name="language[]" value="{{ $code }}"
                                           {{ in_array($code, request('language', [])) ? 'checked' : '' }}
                                           onchange="document.getElementById('filterForm').submit()">
                                    {{ $label }}
                                </label></li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-group open">
                    <button type="button" class="filter-toggle"
                            onclick="this.parentElement.classList.toggle('open')">
                        TYPE <span class="filter-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <ul class="filter-list">
                        @foreach($categories as $category)
                            <li><label>
                                    <input type="checkbox" name="type[]" value="{{ $category->category_id }}"
                                           {{ in_array($category->category_id, request('type', [])) ? 'checked' : '' }}
                                           onchange="document.getElementById('filterForm').submit()">
                                    {{ $category->type }}
                                </label></li>
                        @endforeach
                    </ul>
                </div>
                <div class="filter-group open">
                    <button type="button" class="filter-toggle"
                            onclick="this.parentElement.classList.toggle('open')">
                        PRICE <span class="filter-arrow"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <div class="filter-price">
                        <div class="price-range-labels">
                            <span>2 €</span>
                            <span id="priceMaxLabel">{{ request('price_max', 100) }} €</span>
                        </div>
                        <input type="range" name="price_max" min="2" max="100" step="1"
                               value="{{ request('price_max', 100) }}"
                               class="price-slider" id="sliderMax"
                               oninput="document.getElementById('priceMaxLabel').textContent = this.value + ' €'"
                               onchange="document.getElementById('filterForm').submit()">
                    </div>
                </div>
            </div>
        </form>

        {{-- KNIHY --}}
        <div class="book-section">
            <div class="sort-bar">
                <span>Sort by</span>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}"
                   class="sort-btn {{ request('sort', 'price_asc') == 'price_asc' ? 'active' : '' }}">Price ↑</a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}"
                   class="sort-btn {{ request('sort') == 'price_desc' ? 'active' : '' }}">Price ↓</a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}"
                   class="sort-btn {{ request('sort') == 'name_asc' ? 'active' : '' }}">A → Z</a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}"
                   class="sort-btn {{ request('sort') == 'name_desc' ? 'active' : '' }}">Z → A</a>
            </div>

            <div class="books">
                @forelse($books as $book)
                    <a href="{{ route('books.show', $book->book_id) }}" class="book-card">
                        @if($book->photo1)
                            <img class="book-cover" src="{{ asset('pictures/' . $book->photo1) }}"
                                 alt="{{ $book->name }}">
                        @else
                            <div class="book-cover"></div>
                        @endif
                        <p class="book-title">{{ $book->name }}</p>
                        <p class="book-author">{{ $book->author }}</p>
                            @if($book->is_on_sale)
                                <p class="book-price"><s>{{ number_format($book->original_price, 2) }}€</s> {{ number_format($book->price, 2) }}€</p>
                                <p class="book-sale">SALE</p>
                            @else
                                <p class="book-price">{{ number_format($book->price, 2) }}€</p>
                            @endif
                    </a>
                @empty
                    <p>Žiadne knihy sa nenašli.</p>
                @endforelse
            </div>

            {{-- STRÁNKOVANIE --}}
            <div class="numbering">
                {{-- Previous --}}
                @if ($books->onFirstPage())
                    <span class="page-disabled">«</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}">«</a>
                @endif

                {{-- Čísla stránok - max 3 --}}
                @php
                    $current = $books->currentPage();
                    $last = $books->lastPage();

                    if ($last <= 3) {
                        $start = 1;
                        $end = $last;
                    } elseif ($current == 1) {
                        $start = 1;
                        $end = 3;
                    } elseif ($current == $last) {
                        $start = $last - 2;
                        $end = $last;
                    } else {
                        $start = $current - 1;
                        $end = $current + 1;
                    }
                @endphp

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <a class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $books->url($page) }}">{{ $page }}</a>
                    @endif
                @endfor

                {{-- Next --}}
                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}">»</a>
                @else
                    <span class="page-disabled">»</span>
                @endif
            </div>
        </div>

    </div>
</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <a href="/" class="logo">LEXEM</a>
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

    function updateSlider() {
        const min = parseInt(document.getElementById('sliderMin').value);
        const max = parseInt(document.getElementById('sliderMax').value);

        if (min > max) {
            document.getElementById('sliderMin').value = max;
        }

        document.getElementById('priceMinLabel').textContent = Math.min(min, max) + ' €';
        document.getElementById('priceMaxLabel').textContent = Math.max(min, max) + ' €';
    }

    // Po pustení slidera odošli form
    document.querySelectorAll('.price-slider').forEach(slider => {
        slider.addEventListener('change', () => {
            document.getElementById('filterForm').submit();
        });
    });
</script>

</body>
</html>
