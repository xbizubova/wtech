<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — {{ $book->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

<main>
    <form method="POST" action="{{ route('admin.books.update', $book->book_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="book-detail">

            <div class="book-detail-cover">
                @if($book->photo1)
                    <img src="{{ asset('pictures/' . $book->photo1) }}" alt="Book cover" style="width:100%; border-radius:8px; margin-bottom:16px;">
                @endif
                <div class="field-group">
                    <label class="field-label">Photo 1</label>
                    <input type="file" name="photo1" accept="image/*">
                </div>
                <div class="field-group">
                    <label class="field-label">Photo 2</label>
                    <input type="file" name="photo2" accept="image/*">
                </div>
            </div>

            <div class="book-detail-info">
                <input type="text" class="book-detail-title-write" name="name"
                       value="{{ $book->name }}" required>
                <input type="text" class="book-detail-author-write" name="author"
                       value="{{ $book->author }}" required>
                <div class="description-wrapper expanded">
                    <label class="field-label">Description</label>
                    <textarea class="big-field-input" name="detail" rows="10">{{ $book->detail }}</textarea>
                </div>
            </div>

            <div class="book-detail-extras">
                <input type="number" step="0.01" class="book-detail-price" name="price"
                       value="{{ $book->price }}" placeholder="Price in €" required>
                <input type="number" step="0.01" class="book-detail-price" name="original_price"
                       value="{{ $book->original_price }}" placeholder="Original price (if on sale)">
                <input type="text" class="book-detail-language" name="language"
                       value="{{ $book->language }}" placeholder="Language (EN/SK/CZ)" required>
                <input type="number" class="book-detail-language" name="amount"
                       value="{{ $book->amount }}" placeholder="Amount in stock" required>
                <input type="date" class="book-detail-language" name="release_date"
                       value="{{ $book->release_date }}">

                <div class="field-group">
                    <label><input type="checkbox" name="is_on_sale" {{ $book->is_on_sale ? 'checked' : '' }}> On Sale</label>
                    <label><input type="checkbox" name="is_booktok" {{ $book->is_booktok ? 'checked' : '' }}> Booktok Trending</label>
                    <label><input type="checkbox" name="is_recommended" {{ $book->is_recommended ? 'checked' : '' }}> We Recommend</label>
                </div>

                <div class="field-group">
                    <label class="field-label">Categories</label>
                    @foreach($categories as $category)
                        <label>
                            <input type="checkbox" name="categories[]" value="{{ $category->category_id }}"
                                {{ $book->categories->contains('category_id', $category->category_id) ? 'checked' : '' }}>
                            {{ $category->type }}
                        </label>
                    @endforeach
                </div>

                <div class="book-detail-add">
                    @if($book->amount <= 0)
                        <p style="text-align:center; font-family:'Jost',sans-serif; letter-spacing:0.1em; color:#c0392b; font-size:0.85rem; text-transform:uppercase; padding:12px 0;">Out of stock</p>
                    @endif
                    <button type="submit">SAVE</button>
                </div>
            </div>

            <div class="rating">
                <p class="rating-label">RATING</p>
                <input type="hidden" name="rating" id="ratingValue" value="{{ $book->rating }}">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $book->rating ? 'active' : '' }}" data-value="{{ $i }}">★</span>
                    @endfor
                </div>
            </div>

        </div>
    </form>

    <div style="text-align:center; margin-top: 32px; display:flex; flex-direction:column; align-items:center; gap:16px;">

        @if($book->amount <= 0)
            <form method="POST" action="{{ route('admin.books.restock', $book->book_id) }}" style="display:flex; align-items:center; gap:8px;">
                @csrf
                @method('PATCH')
                <input type="number" name="restock_amount" min="1" value="1"
                       style="width:70px; text-align:center; font-family:'Jost',sans-serif; font-size:0.9rem; border:1px solid #ccc; border-radius:4px; padding:6px;">
                <button type="submit" class="book-detail-add" style="color:green;">RESTOCK</button>
            </form>
        @endif

        @if($book->is_hidden)
            <form method="POST" action="{{ route('admin.books.restore', $book->book_id) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="book-detail-add" style="color:green;">RESTORE</button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.books.destroy', $book->book_id) }}"
                  onsubmit="return confirm('Naozaj chceš skryť túto knihu?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="book-detail-add" style="color:red;">REMOVE</button>
            </form>
        @endif
    </div>
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
</script>
</body>
</html>
