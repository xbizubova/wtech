<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Add Book</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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
</header>

<form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-wrap">

        {{-- ── ĽAVÝ STĹPEC: obrázky ── --}}
        <div class="admin-left">
            <div class="cover-placeholder" id="coverPreview">No image</div>
            <div id="thumbsPreview" style="display:flex; flex-wrap:wrap; gap:8px; margin-top:8px;"></div>
            <div class="upload-btn-wrap">
                <label class="field-label">Images</label>
                <input type="file" name="new_images[]" multiple accept="image/*"
                       onchange="previewCovers(this)">
            </div>
        </div>

        {{-- ── PRAVÝ STĹPEC: formulár ── --}}
        <div class="admin-right">

            @if($errors->any())
                <div style="background:#fdecea; border-radius:8px; padding:16px; font-family:'Jost',sans-serif; font-size:0.85rem; color:#c0392b;">
                    <ul style="margin:0; padding-left:16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Základné info --}}
            <div class="admin-section">
                <h3>Basic informations</h3>
                <div class="field-row">
                    <div class="field-item full">
                        <label>Title</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Book Title" required>
                    </div>
                    <div class="field-item full">
                        <label>Author</label>
                        <input type="text" name="author" value="{{ old('author') }}" placeholder="Book Author" required>
                    </div>
                    <div class="field-item full">
                        <label>Description</label>
                        <textarea name="detail" placeholder="Book Description">{{ old('detail') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Cena & sklad --}}
                <div class="admin-section">
                    <h3>Price and Storage</h3>
                    <div class="field-row">
                        <div class="field-item">
                            <label>Price (€)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00" required id="priceInput">
                        </div>
                        <div class="field-item">
                            <label>Discount (%)</label>
                            <input type="number" step="1" name="discount" value="{{ old('discount') }}" placeholder="0" min="0" max="100" id="discountInput">
                        </div>
                        <div class="field-item">
                            <label>Final price (€)</label>
                            <input type="text" id="finalPrice" placeholder="—" readonly style="opacity:0.6;">
                        </div>
                        <div class="field-item">
                            <label>Sale start</label>
                            <input type="date" name="start_sale" value="{{ old('start_sale') }}">
                        </div>
                        <div class="field-item">
                            <label>Sale end</label>
                            <input type="date" name="end_sale" value="{{ old('end_sale') }}">
                        </div>
                        <div class="field-item">
                            <label>In stock</label>
                            <input type="number" name="amount" value="{{ old('amount') }}" placeholder="0" required>
                        </div>
                        <div class="field-item">
                            <label>Language</label>
                            <input type="text" name="language" value="{{ old('language') }}" placeholder="EN / SK / CZ" required>
                        </div>
                        <div class="field-item">
                            <label>Date of issue</label>
                            <input type="date" name="release_date" value="{{ old('release_date') }}">
                        </div>
                    </div>
                </div>

            {{-- Príznaky --}}
            <div class="admin-section">
                <h3>Properties</h3>
                <div class="checks-row">
                    <label class="check-label">
                        <input type="checkbox" name="is_booktok" {{ old('is_booktok') ? 'checked' : '' }}>
                        Booktok Trending
                    </label>
                    <label class="check-label">
                        <input type="checkbox" name="is_recommended" {{ old('is_recommended') ? 'checked' : '' }}>
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
                                {{ in_array($category->category_id, old('categories', [])) ? 'checked' : '' }}>
                            {{ $category->type }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Rating --}}
            <div class="admin-section">
                <h3>Rating</h3>
                <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', 0) }}">
                <div class="stars-row">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ old('rating', 0) >= $i ? 'active' : '' }}" data-value="{{ $i }}">★</span>
                    @endfor
                </div>
            </div>

            {{-- Uložiť --}}
            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn-save">ADD A BOOK</button>
            </div>

        </div>
    </div>
</form>

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
    const stars = document.querySelectorAll('.star');
    const ratingValue = document.getElementById('ratingValue');
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const val = +star.dataset.value;
            ratingValue.value = val;
            stars.forEach(s => s.classList.toggle('active', +s.dataset.value <= val));
        });
    });

    function previewCovers(input) {
        const preview = document.getElementById('coverPreview');
        const thumbs = document.getElementById('thumbsPreview');
        thumbs.innerHTML = '';

        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = e => {
                    if (index === 0) {
                        preview.innerHTML = `<img src="${e.target.result}"
                        style="width:100%; height:100%; object-fit:cover; border-radius:10px;">`;
                    } else {
                        const thumb = document.createElement('img');
                        thumb.src = e.target.result;
                        thumb.style = 'width:72px; height:96px; object-fit:cover; border-radius:6px;';
                        thumbs.appendChild(thumb);
                    }
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function switchPreviewCover(el) {
        document.querySelectorAll('#previewThumbs img').forEach(i => i.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('coverPreview').innerHTML =
            `<img src="${el.src}" style="width:100%; height:100%; object-fit:cover; border-radius:10px;">`;
    }
</script>
</body>
</html>
