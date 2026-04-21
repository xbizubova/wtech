<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXEM — Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">LEXEM</a>
</header>

<main>
    <div class="login-box">
        <h2>ADMIN LOGIN</h2>

        @if($errors->any())
            <p style="color:red; font-size:0.8rem;">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="email">
                <label for="email">email</label>
                <div class="input-icon1">
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}" required autofocus>
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>

            <div class="password">
                <label for="password">password</label>
                <div class="input-icon2">
                    <input id="password" type="password" name="password" required>
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">LOG IN</button>
        </form>
    </div>
</main>

<script>
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
