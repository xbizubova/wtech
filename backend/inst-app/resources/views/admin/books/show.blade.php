<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — {{ $book->name }}</title>
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

        /* ── ľavý stĺpec ── */
        .admin-left { display: flex; flex-direction: column; gap: 16px; }

        .admin-cover {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .gallery-thumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .gallery-thumb {
            position: relative;
            width: 72px;
            height: 96px;
        }

        .gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s;
        }

        .gallery-thumb img.active { border-color: #2c2c2c; }

        .gallery-thumb .thumb-delete {
            position: absolute;
            top: -6px; right: -6px;
            background: #c0392b;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 20px; height: 20px;
            font-size: 12px;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            line-height: 1;
        }

        .upload-btn-wrap {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .upload-btn-wrap label.field-label {
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #999;
            font-family: 'Jost', sans-serif;
        }

        /* ── pravý stĺpec ── */
        .admin-right {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

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

        .field-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .field-item label {
            font-family: 'Jost', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #999;
        }

        .field-item input,
        .field-item textarea,
        .field-item select {
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

        .field-item textarea {
            resize: vertical;
            min-height: 120px;
        }

        .field-item.full { grid-column: 1 / -1; }

        /* checkboxy */
        .checks-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

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

        /* kategórie */
        .categories-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

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

        /* hviezdy */
        .stars-row {
            display: flex;
            gap: 6px;
        }

        .stars-row .star {
            font-size: 1.8rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.15s;
        }

        .stars-row .star.active { color: #2c2c2c; }

        /* akčné tlačidlá */
        .admin-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

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

        .btn-danger {
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            background: transparent;
            color: #c0392b;
            border: 1.5px solid #c0392b;
            border-radius: 8px;
            padding: 11px 22px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-danger:hover { background: #c0392b; color: #fff; }

        .btn-success {
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            background: transparent;
            color: #27ae60;
            border: 1.5px solid #27ae60;
            border-radius: 8px;
            padding: 11px 22px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-success:hover { background: #27ae60; color: #fff; }

        .restock-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .restock-wrap input {
            width: 64px;
            text-align: center;
            font-family: 'Jost', sans-serif;
            font-size: 0.9rem;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            box-sizing: border-box;
        }

        .out-of-stock-badge {
            font-family: 'Jost', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #c0392b;
            background: #fdecea;
            border-radius: 6px;
            padding: 6px 12px;
        }
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

<form method="POST" action="{{ route('admin.books.update', $book->book_id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-wrap">

        {{-- ── ĽAVÝ STĹPEC: obrázky ── --}}
        <div class="admin-left">

            {{-- hlavný obrázok --}}
            <img id="mainCover"
                 src="{{ asset('pictures/' . ($book->images->first()->filename ?? $book->photo1 ?? '')) }}"
                 alt="{{ $book->name }}"
                 class="admin-cover">

            {{-- miniatúry existujúcich obrázkov --}}
            @if($book->images->count())
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
                <label class="field-label">Pridať fotky</label>
                <input type="file" name="new_images[]" multiple accept="image/*">
            </div>
        </div>

        {{-- ── PRAVÝ STĹPEC: formulár ── --}}
        <div class="admin-right">

            {{-- Základné info --}}
            <div class="admin-section">
                <h3>Základné informácie</h3>
                <div class="field-row">
                    <div class="field-item full">
                        <label>Názov</label>
                        <input type="text" name="name" value="{{ $book->name }}" required>
                    </div>
                    <div class="field-item full">
                        <label>Autor</label>
                        <input type="text" name="author" value="{{ $book->author }}" required>
                    </div>
                    <div class="field-item full">
                        <label>Popis</label>
                        <textarea name="detail">{{ $book->detail }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Cena & sklad --}}
            <div class="admin-section">
                <h3>Cena & sklad</h3>
                <div class="field-row">
                    <div class="field-item">
                        <label>Cena (€)</label>
                        <input type="number" step="0.01" name="price" value="{{ $book->price }}" required>
                    </div>
                    <div class="field-item">
                        <label>Pôvodná cena (€)</label>
                        <input type="number" step="0.01" name="original_price" value="{{ $book->original_price }}">
                    </div>
                    <div class="field-item">
                        <label>Množstvo na sklade</label>
                        <input type="number" name="amount" value="{{ $book->amount }}" required>
                    </div>
                    <div class="field-item">
                        <label>Jazyk</label>
                        <input type="text" name="language" value="{{ $book->language }}" placeholder="EN / SK / CZ" required>
                    </div>
                    <div class="field-item">
                        <label>Dátum vydania</label>
                        <input type="date" name="release_date" value="{{ $book->release_date }}">
                    </div>
                </div>
            </div>

            {{-- Príznaky --}}
            <div class="admin-section">
                <h3>Príznaky</h3>
                <div class="checks-row">
                    <label class="check-label">
                        <input type="checkbox" name="is_on_sale" {{ $book->is_on_sale ? 'checked' : '' }}>
                        On Sale
                    </label>
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
                <h3>Kategórie</h3>
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
                <h3>Akcie</h3>
                <div class="admin-actions">

                    @if($book->amount <= 0)
                        <span class="out-of-stock-badge">Out of stock</span>
                    @endif

                    <button type="submit" class="btn-save">Uložiť zmeny</button>

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
        if (!confirm('Vymazať tento obrázok?')) return;
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
