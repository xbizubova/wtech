<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — {{ $book->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body>

<header>
    <a href="{{ route('admin.home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
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
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">LOG OUT</button>
    </form>
</nav>

<form method="POST" action="{{ route('admin.books.update', $book->book_id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-wrap">

        {{-- ── ĽAVÝ STĹPEC: obrázky ── --}}
        <div class="admin-left">
            {{-- hlavný obrázok --}}
            @if($book->images->isNotEmpty())
                <img id="mainCover"
                     src="{{ asset('pictures/' . $book->images->first()->filename) }}"
                     alt="{{ $book->name }}"
                     class="admin-cover">
            @else
                <div class="cover-placeholder">No image</div>
            @endif

            {{-- miniatúry --}}
            @if($book->images->count() > 1)
                <div class="gallery-thumbs">
                    @foreach($book->images as $img)
                        <div class="gallery-thumb">
                            <img src="{{ asset('pictures/' . $img->filename) }}"
                                 alt=""
                                 class="{{ $loop->first ? 'active' : '' }}"
                                 onclick="switchCover(this)">
                            <button type="button"
                                    class="thumb-delete"
                                    onclick="deleteImage({{ $img->image_id }}, this)"
                                    title="Vymazať">×</button>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- nahrať nové obrázky --}}
            <div class="upload-btn-wrap">
                <form method="POST" action="{{ route('admin.books.uploadImages', $book->book_id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <label class="field-label">Add Images</label>
                    <input type="file" name="new_images[]" multiple accept="image/*">
                    <button type="submit" class="btn-save" style="margin-top: 8px;">UPLOAD IMAGES</button>
                </form>
            </div>
        </div>

        {{-- ── PRAVÝ STĹPEC: formulár ── --}}
        <div class="admin-right">

            {{-- Základné info --}}
            <div class="admin-section">
                <h3>Basic informations</h3>
                <div class="field-row">
                    <div class="field-item full">
                        <label>Title</label>
                        <input type="text" name="name" value="{{ $book->name }}" required>
                        @error('name')
                        <span style="color:#c0392b; font-size:0.75rem; font-family:'Jost',sans-serif;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field-item full">
                        <label>Author</label>
                        <input type="text" name="author" value="{{ $book->author }}" required>
                        @error('author')
                        <span style="color:#c0392b; font-size:0.75rem; font-family:'Jost',sans-serif;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field-item full">
                        <label>Description</label>
                        <textarea name="detail">{{ $book->detail }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Cena & sklad --}}
            <div class="admin-section">
                <h3>Price and Storage</h3>
                <div class="field-row">
                    <div class="field-item">
                        <label>Price (€)</label>
                        <input type="number" step="0.01" name="price" value="{{ $book->price }}" required id="priceInput">
                        @error('price')
                        <span style="color:#c0392b; font-size:0.75rem; font-family:'Jost',sans-serif;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field-item">
                        <label>Discount (%)</label>
                        <input type="number" step="1" name="discount" min="0" max="100" id="discountInput"
                               value="{{ $book->sale ? round((1 - $book->sale->price_modifier) * 100) : '' }}">
                        @error('discount')
                        <span style="color:#c0392b; font-size:0.75rem; font-family:'Jost',sans-serif;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field-item">
                        <label>Final Price (€)</label>
                        <input type="text" id="finalPrice" readonly style="opacity:0.6;"
                               value="{{ $book->is_on_sale && $book->sale ? $book->final_price . ' €' : $book->price . ' €' }}">
                    </div>
                    <div class="field-item">
                        <label>Sale Start</label>
                        <input type="date" name="start_sale" value="{{ $book->sale?->start_sale }}">
                    </div>
                    <div class="field-item">
                        <label>Sale End</label>
                        <input type="date" name="end_sale" value="{{ $book->sale?->end_sale }}">
                    </div>
                    <div class="field-item">
                        <label>In Stock</label>
                        <input type="number" name="amount" value="{{ $book->amount }}" required>
                        @error('amount')
                        <span style="color:#c0392b; font-size:0.75rem; font-family:'Jost',sans-serif;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field-item">
                        <label>Language</label>
                        <input type="text" name="language" value="{{ $book->language }}" placeholder="EN / SK / CZ" required>
                        @error('language')
                        <span style="color:#c0392b; font-size:0.75rem; font-family:'Jost',sans-serif;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field-item">
                        <label>Release Date</label>
                        <input type="date" name="release_date" value="{{ $book->release_date }}">
                        @error('release_date')
                        <span style="color:#c0392b; font-size:0.75rem; font-family:'Jost',sans-serif;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Príznaky --}}
            <div class="admin-section">
                <h3>Properties</h3>
                <div class="checks-row">
                    <label class="check-label">
                        <input type="checkbox" name="is_booktok" {{ $book->is_booktok ? 'checked' : '' }}>
                        Booktok Trending
                    </label>
                    <label class="check-label">
                        <input type="checkbox" name="is_recommended" {{ $book->is_recommended ? 'checked' : '' }}>
                        We Recommend
                    </label>
                </div>
            </div>

            {{-- Kategórie --}}
            <div class="admin-section">
                <h3>Categories</h3>
                <div class="categories-grid">
                    @foreach($categories as $category)
                        <label class="cat-label">
                            <input type="checkbox" name="categories[]" value="{{ $category->category_id }}"
                                {{ $book->categories->contains('category_id', $category->category_id) ? 'checked' : '' }}>
                            {{ $category->type }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Rating --}}
            <div class="admin-section">
                <h3>Rating</h3>
                <input type="hidden" name="rating" id="ratingValue" value="{{ $book->rating }}">
                <div class="stars-row">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $book->rating ? 'active' : '' }}" data-value="{{ $i }}">★</span>
                    @endfor
                </div>
            </div>

            {{-- Akcie --}}
            <div class="admin-section">
                <h3>Actions</h3>
                <div class="admin-actions">

                    @if($book->amount <= 0)
                        <span class="out-of-stock-badge">Out of stock</span>
                    @endif

                    <button type="submit" class="btn-save">Save Changes</button>

                    @if($book->amount <= 0)
                        {{-- restock je mimo hlavného formu --}}
                    @endif
                </div>
            </div>

        </div>
    </div>
</form>

{{-- Restock & Remove/Restore — mimo hlavného formu --}}
<div style="max-width:1100px; margin: 0 auto 48px; padding: 0 24px; display:flex; gap:12px; flex-wrap:wrap; justify-content:flex-end;">

    @if($book->amount <= 0)
        <form method="POST" action="{{ route('admin.books.restock', $book->book_id) }}" class="restock-wrap">
            @csrf
            @method('PATCH')
            <input type="number" name="restock_amount" min="1" value="1">
            <button type="submit" class="btn-success">Restock</button>
        </form>
    @endif

    @if($book->is_hidden)
        <form method="POST" action="{{ route('admin.books.restore', $book->book_id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn-success">Restore</button>
        </form>
    @else
        <form method="POST" action="{{ route('admin.books.destroy', $book->book_id) }}"
              onsubmit="return confirm('Naozaj chceš skryť túto knihu?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Remove</button>
        </form>
    @endif
</div>

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
    // prepínanie hlavného obrázka
    function switchCover(el) {
        document.querySelectorAll('.gallery-thumb img').forEach(i => i.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('mainCover').src = el.src;
    }

    // mazanie obrázka cez AJAX
    function deleteImage(imageId, btn) {
        if (!confirm('Delete this image?')) return;
        fetch(`/ninkaalexsupertajnastranka/books/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    ?? '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const thumb = btn.closest('.gallery-thumb');
                    const wasActive = thumb.querySelector('img').classList.contains('active');
                    thumb.remove();
                    // ak sme zmazali aktívny, ukáž prvý zostatok
                    if (wasActive) {
                        const first = document.querySelector('.gallery-thumb img');
                        if (first) switchCover(first);
                    }
                }
            });
    }
    //zlava
    const priceInput = document.getElementById('priceInput');
    const discountInput = document.getElementById('discountInput');
    const finalPrice = document.getElementById('finalPrice');

    function calcFinal() {
        const price = parseFloat(priceInput?.value) || 0;
        const discount = parseFloat(discountInput?.value) || 0;
        if (price > 0 && discount > 0) {
            finalPrice.value = (price * (1 - discount / 100)).toFixed(2) + ' €';
        } else {
            finalPrice.value = price > 0 ? price.toFixed(2) + ' €' : '—';
        }
    }

    priceInput?.addEventListener('input', calcFinal);
    discountInput?.addEventListener('input', calcFinal);
    calcFinal();


    // hviezdy
    const stars = document.querySelectorAll('.star');
    const ratingValue = document.getElementById('ratingValue');
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const val = +star.dataset.value;
            ratingValue.value = val;
            stars.forEach(s => s.classList.toggle('active', +s.dataset.value <= val));
        });
    });
</script>
</body>
</html>
