<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Shipping Method</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        .toast-error {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #c0392b;
            color: white;
            padding: 18px 40px;
            border-radius: 50px;
            font-family: 'Jost', sans-serif;
            font-size: 15px;
            letter-spacing: 0.5px;
            z-index: 9999;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            display: none;
        }
    </style>
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        <a href="{{ route('account') }}" class="btn-login">ACCOUNT</a>
    </nav>
</header>

<main>
    <form method="POST" action="{{ route('order.save-shipping') }}" id="shippingForm">
        @csrf
        <div class="shipping-container">
            <h1 class="shipping-title">Shipping Method</h1>

            <div class="method-list">
                <label class="method-option">
                    <input type="radio" name="shipping_method" class="method-radio" value="home">
                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                <rect x="1" y="3" width="15" height="13" rx="1"/>
                                <path d="M16 8h4l3 5v3h-7V8z"/>
                                <circle cx="5.5" cy="18.5" r="2.5"/>
                                <circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                        </div>
                        <span class="method-name">Home delivery</span>
                        <span class="method-price">2,99 €</span>
                    </div>
                </label>

                <label class="method-option">
                    <input type="radio" name="shipping_method" class="method-radio" value="pickup-point">
                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <span class="method-name">Pick up point</span>
                        <span class="method-price">1,99 €</span>
                    </div>
                </label>

                <label class="method-option">
                    <input type="radio" name="shipping_method" class="method-radio" value="pickup-store">
                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <span class="method-name">Pick up in store</span>
                        <span class="method-price">0,00 €</span>
                    </div>
                </label>
            </div>
        </div>

        <div class="step-wrapper">
            <button type="button" class="btn-step" id="submitBtn">
                Payment Method
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        </div>
    </form>

    <div class="toast-error" id="toast"></div>
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
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contact information</h4>
            <ul>
                <li>Bratislava, Dúhová 17</li>
                <li>support@lexem.sk</li>
            </ul>
        </div>
    </div>
</footer>

<script>
    document.getElementById('submitBtn').addEventListener('click', function () {
        const shippingSelected = document.querySelector('input[name="shipping_method"]:checked');

        if (!shippingSelected) {
            showToast('You need to select a shipping method.');
            return;
        }

        document.getElementById('shippingForm').submit();
    });

    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.style.display = 'block';
        toast.style.opacity = '1';
        toast.style.transition = 'none';

        setTimeout(() => {
            toast.style.transition = 'opacity 0.5s ease';
            toast.style.opacity = '0';
            setTimeout(() => { toast.style.display = 'none'; }, 500);
        }, 4000);
    }
</script>
</body>
</html>
