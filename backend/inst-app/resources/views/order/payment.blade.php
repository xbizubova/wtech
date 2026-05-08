<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Payment Method</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        <a href="{{ route('account') }}" class="btn-login">ACCOUNT</a>
    </nav>
</header>

<main>
    <form method="POST" action="{{ route('order.save-payment') }}">
        @csrf
        <div class="shipping-container">
            <h1 class="shipping-title">Payment Method</h1>

            <div class="method-list">
                <label class="method-option">
                    <input type="radio" name="payment_method" class="method-radio" value="card" required>
                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                <rect x="1" y="4" width="22" height="16" rx="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                        </div>
                        <span class="method-name">Card Payment</span>
                    </div>
                </label>

                <label class="method-option">
                    <input type="radio" name="payment_method" class="method-radio" value="bank">
                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                <path d="M3 22h18M3 10h18M5 10V22M9 10V22M15 10V22M19 10V22M12 2L2 10h20L12 2z"/>
                            </svg>
                        </div>
                        <span class="method-name">Payment by bank transfer</span>
                    </div>
                </label>

                <label class="method-option">
                    <input type="radio" name="payment_method" class="method-radio" value="cash">
                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4">
                                <path d="M20 12V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2v-2"/>
                                <path d="M20 12h-6a2 2 0 000 4h6v-4z"/>
                            </svg>
                        </div>
                        <span class="method-name">Cash on delivery</span>
                    </div>
                </label>
            </div>

            <label class="checkbox-label" style="justify-content: center;">
                <input type="checkbox" class="checkbox-input" required>
                <span class="checkbox-box"></span>
                <span class="checkbox-text">I Agree To Terms And Conditions.</span>
            </label>
        </div>

        <div class="step-wrapper">
            <button type="button" class="btn-step" onclick="
        if (!document.querySelector('.checkbox-input').checked) {
            alert('You must agree to the Terms and Conditions!');
            return;
        }
        this.closest('form').submit();
    ">
                Order Summary
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
            <h4>Contact information</h4>
            <ul>
                <li>Bratislava, Dúhová 17</li>
                <li>support@lexem.sk</li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>
