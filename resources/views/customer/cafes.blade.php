<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a Café</title>

    @vite([
        'resources/css/app.css',
        'resources/css/customer-cafe-selection.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="container">

    <div class="navbar">

        <div class="user-greeting">
            ☕ Welcome, {{ Auth::user()->name }} !
        </div>

        <div class="nav-actions">

            <a href="{{ route('customer.order.history') }}"
               class="nav-btn">
                Order History
            </a>

            <form method="POST"
                  action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="nav-btn">
                    Logout
                </button>
            </form>

        </div>

    </div>

    <div class="hero">

        

        <h1>Choose Your Café</h1>

        <p>
            Browse available cafés and start ordering your favourite meals.
        </p>

    </div>

    <div class="cafe-grid">

        @foreach ($cafes as $cafe)

            <a href="{{ route('customer.menu', $cafe->id) }}"
               class="cafe-card">


                <div class="cafe-name">
                    {{ $cafe->name }}
                </div>

            </a>

        @endforeach

    </div>

</div>

</body>
</html>