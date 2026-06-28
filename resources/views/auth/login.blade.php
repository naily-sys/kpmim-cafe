<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>

    @vite([
        'resources/css/app.css',
        'resources/css/customer-login.css',
        'resources/js/app.js'
    ])
</head>
<body>

    <div class="card">

        <div class="logo">☕</div>

        <h1>Welcome Back!</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label>Email Address</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
            >

            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror

            <label>Password</label>
            <input
                type="password"
                name="password"
                required
            >

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn">
                Login
            </button>
        </form>

        <div class="register-link">
            Don't have an account?
            <a href="{{ route('customer.register') }}">
                Register here
            </a>
        </div>

        <a href="/" class="back-home">
            ← Back to Home
        </a>

    </div>

</body>
</html>