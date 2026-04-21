<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Add Book</title>
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
    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="book-detail">

            <div class="book-detail-cover">
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
                <input type="text" class="book-detail-title-write" name="name" placeholder="Title" required>
                <input type="text" class="book-detail-author-write" name="author" placeholder="Author" required>
                <div class="description-wrapper expanded">
                    <label class="field-label">Description</label>
                    <textarea class="big-field-input" name="detail" rows="10" placeholder="Add book description"></textarea>
                </div>
            </div>

            <div class="book-detail-extras">
                <input type="number" step="0.01" class="book-detail-price" name="price" placeholder="Price in €" required>
                <input type="number" step="0.01" class="book-detail-price" name="original_price" placeholder="Original price (if on sale)">
                <input type="text" class="book-detail-language" name="language" placeholder="Language (EN/SK/CZ)" required>
                <input type="number" class="book-detail-language" name="amount" placeholder="Amount in stock" required>
                <input type="date" class="book-detail-language" name="release_date">

                <div class="field-group">
                    <label><input type="checkbox" name="is_on_sale"> On Sale</label>
                    <label><input type="checkbox" name="is_booktok"> Booktok Trending</label>
                    <label><input type="checkbox" name="is_recommended"> We Recommend</label>
                </div>

                <div class="field-group">
                    <label class="field-label">Categories</label>
                    @foreach($categories as $category)
                        <label>
                            <input type="checkbox" name="categories[]" value="{{ $category->category_id }}">
                            {{ $category->type }}
                        </label>
                    @endforeach
                </div>

                <div class="book-detail-add">
                    <button type="submit">SAVE</button>
                </div>
            </div>

            <div class="rating">
                <p class="rating-label">RATING</p>
                <input type="hidden" name="rating" id="ratingValue" value="0">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}">★</span>
                    @endfor
                </div>
            </div>

        </div>
    </form>
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

    const hamburger = document.getElementById('hamburger');
    const mobileNav = document.getElementById('mobileNav');
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            mobileNav.classList.toggle('open');
        });
    }
</script>
</body>
</html>
