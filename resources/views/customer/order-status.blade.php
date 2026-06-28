<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>

    @vite([
        'resources/css/app.css',
        'resources/css/order-status.css',
        'resources/js/app.js'
    ])

    <meta http-equiv="refresh" content="30">
</head>
<body>

<div class="card">

    @if($order->status === 'pending')

        <div class="icon">⏳</div>

        <h1>Order Placed!</h1>

        <p class="description">
            Your order has been received and is waiting to be prepared.
        </p>

        <span class="status-badge status-pending">
            Pending
        </span>

    @elseif($order->status === 'preparing')

        <div class="icon">👨‍🍳</div>

        <h1>Being Prepared!</h1>

        <p class="description">
            The café is currently preparing your order.
        </p>

        <span class="status-badge status-preparing">
            Preparing
        </span>

    @elseif($order->status === 'ready')

        <div class="icon">✅</div>

        <h1>Ready for Pickup!</h1>

        <p class="description">
            Your order is ready! Please collect it at the café.
        </p>

        <span class="status-badge status-ready">
            Ready for Pickup
        </span>

    @endif

    <div class="order-id">
        Order #{{ $order->id }}
        •
        RM {{ number_format($order->total_price, 2) }}
    </div>

    @if($order->status === 'ready')

        <div class="notification">
            🔔 <strong>Notification:</strong>
            Your order is ready for pickup!
        </div>

    @endif

<div class="actions">


    <a href="{{ route('customer.order.history') }}"
       class="btn btn-primary">
        Order History
    </a>

    <a href="{{ route('cafes.index') }}"
       class="btn btn-dashboard">
        Dashboard
    </a>

</div>

    @if($order->status === 'ready')

        <a href="{{ route('customer.receipt', $order->id) }}"
           class="btn btn-primary receipt-btn">
            View Receipt
        </a>

    @endif

</div>

</body>
</html>