<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cafe->name }} Menu</title>

    @vite([
        'resources/css/app.css',
        'resources/css/customer-menu.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="container">

    <div class="navbar">

        <a href="{{ route('cafes.index') }}" class="back-link">
            ← Back to Cafés
        </a>

        <div class="nav-actions">

            <a href="{{ route('customer.order.history') }}"
               class="nav-btn">
                📋 Orders
            </a>

            <a href="{{ route('customer.cart') }}"
               class="nav-btn">
                🛒 View Cart
            </a>

        </div>

    </div>

    <div class="hero">


        <h1>{{ $cafe->name }}</h1>


    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="section">

        <h2 class="section-title">
            🍽 Food
        </h2>

        @if($foodItems->count())

            <div class="menu-grid">

                @foreach($foodItems as $item)

                    <div class="menu-card">

                        @if($item->image)

                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->name }}">

                        @else

                            <div class="no-image">
                                🍽️
                            </div>

                        @endif

                        <div class="card-content">

                            <div class="item-name">
                                {{ $item->name }}
                            </div>

                            <div class="item-description">
                                {{ $item->description ?? 'No description available.' }}
                            </div>

                            <div class="card-footer">

                                <span class="price">
                                    RM {{ number_format($item->price, 2) }}
                                </span>

                                <form method="POST"
                                      action="{{ route('customer.cart.add') }}">
                                    @csrf

                                    <input type="hidden"
                                           name="menu_item_id"
                                           value="{{ $item->id }}">

                                    <button type="submit"
                                            class="add-btn">
                                        + Add
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <p class="empty">
                No food items available today.
            </p>

        @endif

    </div>

    <div class="section">

        <h2 class="section-title">
            ☕ Beverages
        </h2>

        @if($beverageItems->count())

            <div class="menu-grid">

                @foreach($beverageItems as $item)

                    <div class="menu-card">

                        @if($item->image)

                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->name }}">

                        @else

                            <div class="no-image">
                                ☕
                            </div>

                        @endif

                        <div class="card-content">

                            <div class="item-name">
                                {{ $item->name }}
                            </div>

                            <div class="item-description">
                                {{ $item->description ?? 'No description available.' }}
                            </div>

                            <div class="card-footer">

                                <span class="price">
                                    RM {{ number_format($item->price, 2) }}
                                </span>

                                <form method="POST"
                                      action="{{ route('customer.cart.add') }}">
                                    @csrf

                                    <input type="hidden"
                                           name="menu_item_id"
                                           value="{{ $item->id }}">

                                    <button type="submit"
                                            class="add-btn">
                                        + Add
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <p class="empty">
                No beverages available today.
            </p>

        @endif

    </div>

</div>

</body>
</html>