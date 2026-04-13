<x-guest-layout>
    <div class="login-box">
        <h2>SIGN UP</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="info">
                <label for="email">email</label>
                <div class="input-icon1">
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}" required>
                    <i class="fa-regular fa-user"></i>
                </div>
                @error('email')
                <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="info">
                <label for="name">First name</label>
                <div class="input-icon1">
                    <input id="name" type="text" name="name"
                           value="{{ old('name') }}" required>
                </div>
                @error('name')
                <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="info">
                <label for="password">Create a password</label>
                <div class="input-icon1">
                    <input id="password" type="password" name="password" required>
                </div>
                @error('password')
                <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="info">
                <label for="password_confirmation">Repeat password</label>
                <div class="input-icon1">
                    <input id="password_confirmation" type="password"
                           name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn-login">REGISTER ME!</button>

            <p style="text-align:center; margin-top:1rem;">
                <a href="{{ route('login') }}">Already have an account? Log in</a>
            </p>
        </form>
    </div>
</x-guest-layout>

