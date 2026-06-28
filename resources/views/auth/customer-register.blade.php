<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Register</title>

    @vite([
        'resources/css/app.css',
        'resources/css/customer-register.css',
        'resources/js/app.js'
    ])
</head>
<body>

    <div class="card">

        <div class="logo">☕</div>

        <h1>Create Account</h1>
        

        <form method="POST" action="/customer/register">
            @csrf

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

            <button type="submit" class="btn">
                Create Account
            </button>
        </form>

        <div class="login-link">
            Already have an account?
            <a href="{{ route('customer.login') }}">
                Login here
            </a>
        </div>

        <a href="/" class="back-home">
            ← Back to Home
        </a>

    </div>

</body>
</html>