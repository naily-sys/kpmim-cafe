<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>

    @vite([
        'resources/css/app.css',
        'resources/css/order-history.css',
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
        📋 Order History
    </h1>

    @forelse($orders as $order)

        <div class="order-card">

            <div class="order-header">

                <div class="order-info">

                    <div class="order-id">
                        Order #{{ $order->id }}
                    </div>

                    <div class="cafe-name">
                        {{ $order->cafe->name }}
                    </div>

                    <div class="order-date">
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </div>

                </div>

                <span class="badge badge-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>

            </div>

            <div class="items-list">

                @foreach($order->orderItems as $item)

                    <div class="item-row">

                        <span>
                            {{ $item->menuItem->name }}
                            x{{ $item->quantity }}
                        </span>

                        <span>
                            RM {{ number_format($item->price * $item->quantity, 2) }}
                        </span>

                    </div>

                @endforeach

                <div class="order-total">

                    <span>Total</span>

                    <span>
                        RM {{ number_format($order->total_price, 2) }}
                    </span>

                </div>

                <div class="action-buttons">

                    <a href="{{ route('customer.receipt', $order->id) }}"
                       class="btn-link receipt-btn">
                        Receipt
                    </a>

                    <a href="{{ route('customer.order.status', $order->id) }}"
                       class="btn-link track-btn">
                        Track Order →
                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="empty">

            <div class="empty-icon">
                📋
            </div>

            <p>
                No orders yet!
            </p>

            <a href="{{ route('cafes.index') }}"
               class="start-ordering">
                Start ordering
            </a>

        </div>

    @endforelse

</div>

</body>
</html>