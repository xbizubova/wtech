<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Customer Information</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        <a href="{{ route('account') }}" class="btn-login">ACCOUNT</a>
    </nav>
    <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</header>
<nav class="mobile-nav" id="mobileNav">
    <a href="{{ route('account') }}">Account</a>
    <a href="{{ route('home') }}">Home</a>
</nav>

<main>
    <form method="POST" action="{{ route('order.save-customer-info') }}">
        @csrf
        <div class="shipping-container">
            <h1 class="shipping-title">Customer Information</h1>

            @if($errors->any())
                <div style="color:red; margin-bottom:16px;">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="shipping-form">
                <div class="form-grid">
                    <div class="form-col">
                        <div class="field-group">
                            <label class="field-label">Email</label>
                            <input type="email" class="field-input" name="email"
                                   value="{{ old('email', $user?->email) }}" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">First name</label>
                            <input type="text" class="field-input" name="name"
                                   value="{{ old('name', $user?->name) }}" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Surname</label>
                            <input type="text" class="field-input" name="last_name"
                                   value="{{ old('last_name', $user?->last_name) }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">Phone number</label>
                            <input type="tel" class="field-input" name="phone_number"
                                   value="{{ old('phone_number', $user?->phone_number) }}">
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="field-group">
                            <label class="field-label">Street and house number</label>
                            <input type="text" class="field-input" name="address"
                                   value="{{ old('address', $user?->address) }}" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">City</label>
                            <input type="text" class="field-input" name="city"
                                   value="{{ old('city', $user?->city) }}" required>
                        </div>
                        <div class="field-group">
                            <label class="field-label">State</label>
                            <input type="text" class="field-input" name="state"
                                   value="{{ old('state', $user?->state) }}" required>
                        </div>
                        <div class="form-checkboxes">
                            <label class="checkbox-label">
                                <input type="checkbox" class="checkbox-input">
                                <span class="checkbox-box"></span>
                                <span class="checkbox-text">The Billing Address Is Different From The Delivery Address.</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" class="checkbox-input">
                                <span class="checkbox-box"></span>
                                <span class="checkbox-text">I Invoice The Company.</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-wrapper">
            <button type="submit" class="btn-step">
                Shipping Method
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        </div>
    </form>
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
</script>
</body>
</html>
