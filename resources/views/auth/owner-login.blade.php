<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Login</title>

    @vite([
        'resources/css/app.css',
        'resources/css/owner-login.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="card">

    <div class="logo">☕</div>

    <h1>Owner Login</h1>

    <p class="subtitle">
        Login to manage your café
    </p>

    @if(session('error'))
        <div class="error-box">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('owner.login.store') }}">
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
        <a href="{{ route('owner.register') }}?cafe_id={{ request('cafe_id') }}">
            Register here
        </a>
    </div>

    <a href="/" class="back-link">
        ← Back to Home
    </a>

</div>

</body>
</html>