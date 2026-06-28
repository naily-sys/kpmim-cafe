<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Register</title>

    @vite([
        'resources/css/app.css',
        'resources/css/owner-register.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="card">

    <div class="logo">☕</div>

    <h1>Owner Register</h1>

    <p class="subtitle">
        Create your account to manage your café
    </p>

    <div class="cafe-badge">
        📍 Café {{ request('cafe_id') }}
    </div>

    <form method="POST" action="{{ route('owner.register') }}">
        @csrf

        <input type="hidden"
               name="cafe_id"
               value="{{ request('cafe_id') }}">

        <label>Full Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
        >

        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>Email Address</label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
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

        <label>Confirm Password</label>

        <input
            type="password"
            name="password_confirmation"
            required
        >

        @error('password_confirmation')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn">
            Register as Owner
        </button>

    </form>

    <div class="login-link">
        Already have an account?
        <a href="{{ route('owner.login') }}?cafe_id={{ request('cafe_id') }}">
            Login here
        </a>
    </div>

    <a href="/" class="back-link">
        ← Back to Home
    </a>

</div>

</body>
</html>