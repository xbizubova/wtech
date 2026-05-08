<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Kníhkupectvo</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body>

<header>
    <a href="/" class="logo">LEXEM</a>
    <nav class="header-nav">
        @auth
            <a href="{{ route('account') }}" class="btn-login">ACCOUNT</a>
        @endauth
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
        <a href="{{ route('account') }}">Account</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit()">Log Out</a>
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
    @else
        <a href="{{ route('login') }}">Log In</a>
    @endauth
    <a href="{{ url('/basket') }}">Basket</a>
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
                    <div style="padding: 8px 4px;">
                        <div class="price-range-wrapper">
                            <div class="range-track"></div>
                            <div class="range-fill" id="rangeFill"></div>
                            <input type="range" id="priceMin" name="price_min"
                                   min="0" max="100" step="1"
                                   value="{{ request('price_min', 0) }}">
                            <input type="range" id="priceMax" name="price_max"
                                   min="0" max="100" step="1"
                                   value="{{ request('price_max', 100) }}">
                        </div>
                        <div class="price-labels">
                            <span id="priceMinLabel">{{ request('price_min', 0) }} €</span>
                            <span id="priceMaxLabel">{{ request('price_max', 100) }} €</span>
                        </div>
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
                    @php $images = $book->images; $imageCount = $images->count(); $outOfStock = $book->amount <= 0; @endphp
                    <a href="{{ route('books.show', $book->book_id) }}" class="book-card" style="position:relative; {{ $outOfStock ? 'opacity:0.5; filter:grayscale(60%);' : '' }}">

                        @if($book->photo1)
                            <div style="position:relative;">
                                {{-- Out of stock badge --}}
                                @if($outOfStock)
                                    <span style="position:absolute; top:8px; left:8px; background:#c0392b; color:#fff; font-size:0.65rem; font-family:'Jost',sans-serif; letter-spacing:0.08em; padding:4px 8px; border-radius:2px; z-index:10; text-transform:uppercase;">Out of stock</span>
                                @endif
                                <img class="book-cover book-cover-img"
                                     src="{{ asset('pictures/' . $book->photo1) }}"
                                     alt="{{ $book->name }}"
                                     data-images="{{ $images->pluck('filename')->map(fn($f) => asset('pictures/' . $f))->toJson() }}"
                                     data-index="0">
                                @if($imageCount > 1)
                                    <button type="button" onclick="event.preventDefault(); prevImage(this)"
                                            style="position:absolute; left:4px; top:50%; transform:translateY(-50%); background:rgba(255,255,255,0.8); border:none; border-radius:50%; width:28px; height:28px; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center;">‹</button>
                                    <button type="button" onclick="event.preventDefault(); nextImage(this)"
                                            style="position:absolute; right:4px; top:50%; transform:translateY(-50%); background:rgba(255,255,255,0.8); border:none; border-radius:50%; width:28px; height:28px; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center;">›</button>
                                @endif
                            </div>
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
                @if ($books->onFirstPage())
                    <span class="page-disabled">«</span>
                @else
                    <a href="{{ $books->previousPageUrl() }}">«</a>
                @endif

                @php
                    $current = $books->currentPage();
                    $last = $books->lastPage();
                    if ($last <= 3) { $start = 1; $end = $last; }
                    elseif ($current == 1) { $start = 1; $end = 3; }
                    elseif ($current == $last) { $start = $last - 2; $end = $last; }
                    else { $start = $current - 1; $end = $current + 1; }
                @endphp

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <a class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $books->url($page) }}">{{ $page }}</a>
                    @endif
                @endfor

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

    const priceMin = document.getElementById('priceMin');
    const priceMax = document.getElementById('priceMax');
    const priceMinLabel = document.getElementById('priceMinLabel');
    const priceMaxLabel = document.getElementById('priceMaxLabel');
    const rangeFill = document.getElementById('rangeFill');

    function updateRange() {
        let min = parseInt(priceMin.value);
        let max = parseInt(priceMax.value);
        if (min > max) { priceMin.value = max; min = max; }
        if (max < min) { priceMax.value = min; max = min; }
        const percent1 = (min / 100) * 100;
        const percent2 = (max / 100) * 100;
        rangeFill.style.left = percent1 + '%';
        rangeFill.style.width = (percent2 - percent1) + '%';
        priceMinLabel.textContent = min + ' €';
        priceMaxLabel.textContent = max + ' €';
    }

    priceMin.addEventListener('input', updateRange);
    priceMax.addEventListener('input', updateRange);
    priceMin.addEventListener('change', () => { document.getElementById('filterForm').submit(); });
    priceMax.addEventListener('change', () => { document.getElementById('filterForm').submit(); });
    updateRange();

    function nextImage(btn) {
        const img = btn.closest('div').querySelector('.book-cover-img');
        const images = JSON.parse(img.dataset.images);
        let index = parseInt(img.dataset.index);
        index = (index + 1) % images.length;
        img.src = images[index];
        img.dataset.index = index;
    }

    function prevImage(btn) {
        const img = btn.closest('div').querySelector('.book-cover-img');
        const images = JSON.parse(img.dataset.images);
        let index = parseInt(img.dataset.index);
        index = (index - 1 + images.length) % images.length;
        img.src = images[index];
        img.dataset.index = index;
    }
</script>

</body>
</html>
