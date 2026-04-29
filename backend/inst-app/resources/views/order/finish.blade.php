<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Order Confirmed</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
    <nav class="header-nav">
        <a href="{{ route('account') }}" class="btn-login">ACCOUNT</a>
    </nav>
</header>

<main>
    <div class="order-container">
        <a href="{{ route('home') }}" class="order-logo">LEXEM</a>
        <p class="order-thank">Thank you for your order!</p>
        <p class="order-number">Your order number is<br>{{ $order->order_id }}</p>
    </div>

    <div class="step-wrapper">
        <a href="{{ route('home') }}" class="btn-step">Done</a>
    </div>
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
