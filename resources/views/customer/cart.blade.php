<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>

    @vite([
        'resources/css/app.css',
        'resources/css/customer-cart.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="container">

    <div class="navbar">
        <a href="{{ route('cafes.index') }}" class="back-link">
            ← Back to Cafés
        </a>
    </div>

    <h1 class="page-title">
        🛒 Your Cart
    </h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)

        <table class="cart-table">

            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($cart as $id => $item)

                    <tr>

                        <td>
                            <strong>{{ $item['name'] }}</strong>
                        </td>

                        <td>
                            RM {{ number_format($item['price'], 2) }}
                        </td>

                        <td>
                            {{ $item['quantity'] }}
                        </td>

                        <td>
                            RM {{ number_format($item['price'] * $item['quantity'], 2) }}
                        </td>

                        <td>

                            <form method="POST"
                                  action="{{ route('customer.cart.remove') }}">
                                @csrf

                                <input type="hidden"
                                       name="menu_item_id"
                                       value="{{ $id }}">

                                <button type="submit"
                                        class="btn-remove">
                                    Remove
                                </button>

                            </form>

                        </td>

                    </tr>

                @endforeach

                <tr class="total-row">

                    <td colspan="3">
                        <strong>Total</strong>
                    </td>

                    <td colspan="2">
                        <strong>
                            RM {{ number_format($total, 2) }}
                        </strong>
                    </td>

                </tr>

            </tbody>

        </table>

        <div class="actions">

            <form method="POST"
                  action="{{ route('customer.cart.clear') }}">
                @csrf

                <button type="submit"
                        class="btn-clear">
                    Clear Cart
                </button>
            </form>

            <form method="POST"
                  action="{{ route('customer.order.store') }}">
                @csrf

                <button type="submit"
                        class="btn-order">
                    Place Order →
                </button>
            </form>

        </div>

    @else

        <div class="empty">

            <div class="empty-icon">
                🛒
            </div>

            <p>
                Your cart is empty!
            </p>

            <a href="{{ route('cafes.index') }}"
               class="browse-link">
                Browse Cafés
            </a>

        </div>

    @endif

</div>

</body>
</html>