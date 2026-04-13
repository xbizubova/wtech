<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Jost:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ config('app.name') }}</title>
</head>
<body>

<header>
    <a href="/" class="logo">LEXEM</a>
    <nav class="header-nav">
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-create">CREATE AN ACCOUNT</a>
        @endif
    </nav>
    <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</header>

<nav class="mobile-nav" id="mobileNav">
    <a href="{{ route('login') }}">Log In</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}">Create an Account</a>
    @endif
</nav>

<main>
    {{ $slot }}
</main>

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
