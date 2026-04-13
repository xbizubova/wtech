<x-guest-layout>
    <div class="login-box">
        <h2>LOG IN</h2>

        {{-- Chybová správa pri zlom hesle --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="email">
                <label for="email">email</label>
                <div class="input-icon1">
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}" required autofocus>
                    <i class="fa-regular fa-user"></i>
                </div>
                @error('email')
                <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="password">
                <label for="password">password</label>
                <div class="input-icon2">
                    <input id="password" type="password" name="password" required>
                    <i class="fa-regular fa-eye"></i>
                </div>
                @error('password')
                <p style="color:red; font-size:0.8rem;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-login">LOG IN</button>

            @if (Route::has('password.request'))
                <p style="text-align:center; margin-top:1rem;">
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                </p>
            @endif
        </form>
    </div>
</x-guest-layout>
