<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Add Book</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .admin-wrap {
            max-width: 1100px;
            margin: 48px auto;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 40px;
        }
        .admin-left { display: flex; flex-direction: column; gap: 16px; }
        .cover-placeholder {
            width: 100%;
            aspect-ratio: 2/3;
            background: #eceae4;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #bbb;
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .upload-btn-wrap { display: flex; flex-direction: column; gap: 6px; }
        .upload-btn-wrap label.field-label {
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #999;
            font-family: 'Jost', sans-serif;
        }
        .admin-right { display: flex; flex-direction: column; gap: 32px; }
        .admin-section {
            background: #f5f3ef;
            border-radius: 12px;
            padding: 24px 28px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .admin-section h3 {
            font-family: 'Jost', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #999;
            margin: 0 0 4px 0;
        }
        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .field-item { display: flex; flex-direction: column; gap: 4px; }
        .field-item label {
            font-family: 'Jost', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #999;
        }
        .field-item input,
        .field-item textarea {
            font-family: 'Jost', sans-serif;
            font-size: 0.9rem;
            background: #eceae4;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            color: #2c2c2c;
            width: 100%;
            box-sizing: border-box;
        }
        .field-item textarea { resize: vertical; min-height: 120px; }
        .field-item.full { grid-column: 1 / -1; }
        .checks-row { display: flex; flex-wrap: wrap; gap: 12px; }
        .check-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Jost', sans-serif;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            color: #2c2c2c;
            cursor: pointer;
        }
        .categories-grid { display: flex; flex-wrap: wrap; gap: 8px; }
        .cat-label {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #eceae4;
            border-radius: 20px;
            padding: 5px 12px;
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            cursor: pointer;
        }
        .cat-label input { margin: 0; }
        .stars-row { display: flex; gap: 6px; }
        .stars-row .star {
            font-size: 1.8rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.15s;
        }
        .stars-row .star.active { color: #2c2c2c; }
        .btn-save {
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            background: #2c2c2c;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-save:hover { background: #111; }
    </style>
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

            <div class="upload-btn-wrap">
                <label class="field-label">Images</label>
                <input type="file" name="new_images[]" multiple accept="image/*"
                       onchange="previewCover(this)">
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
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00" required>
                    </div>
                    <div class="field-item">
                        <label>Original price (€)</label>
                        <input type="number" step="0.01" name="original_price" value="{{ old('original_price') }}" placeholder="0.00">
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
                        <input type="checkbox" name="is_on_sale" {{ old('is_on_sale') ? 'checked' : '' }}>
                        On Sale
                    </label>
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
    const stars = document.querySelectorAll('.star');
    const ratingValue = document.getElementById('ratingValue');
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const val = +star.dataset.value;
            ratingValue.value = val;
            stars.forEach(s => s.classList.toggle('active', +s.dataset.value <= val));
        });
    });

    function previewCover(input) {
        const preview = document.getElementById('coverPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `<img src="${e.target.result}"
                    style="width:100%; height:100%; object-fit:cover; border-radius:10px;">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
