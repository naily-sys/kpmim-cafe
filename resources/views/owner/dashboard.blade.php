<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>

    @vite([
        'resources/css/app.css',
        'resources/css/owner-dashboard.css',
        'resources/js/app.js'
    ])
</head>
<body>

<div class="container">

    <div class="header">

        <div>
            <h1 class="title">Owner Dashboard</h1>
            <p class="subtitle">
                Welcome, {{ Auth::user()->name }}!
            </p>
        </div>

        <div class="header-actions">

            <a href="{{ route('owner.menu.index') }}" class="btn">
                📋 Manage Menu
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn logout">
                    Logout
                </button>
            </form>

        </div>

    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-number">
                {{ $pendingOrders->count() }}
            </div>

            <div class="stat-label">
                Pending Orders
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-number">
                {{ $todayOrders->count() }}
            </div>

            <div class="stat-label">
                Total Orders Today
            </div>
        </div>

    </div>

    <h2 class="section-title">
        Incoming Orders
    </h2>

    <table class="orders-table">

        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($todayOrders as $order)

                <tr>

                    <td>
                        <strong>#{{ $order->id }}</strong>
                    </td>

                    <td>
                        {{ $order->user->name }}
                    </td>

                    <td>
                        @foreach($order->orderItems as $item)
                            <small>
                                {{ $item->menuItem->name }}
                                x{{ $item->quantity }}
                            </small>
                            <br>
                        @endforeach
                    </td>

                    <td>
                        RM {{ number_format($order->total_price, 2) }}
                    </td>

                    <td>
                        {{ $order->created_at->format('h:i A') }}
                    </td>

                    <td>
                        <span class="badge badge-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                    <td>

                        @if($order->status === 'pending')

                            <form method="POST"
                                  action="{{ route('owner.order.preparing', $order->id) }}">
                                @csrf
                                <button type="submit" class="btn-preparing">
                                    Preparing
                                </button>
                            </form>

                        @elseif($order->status === 'preparing')

                            <form method="POST"
                                  action="{{ route('owner.order.ready', $order->id) }}">
                                @csrf
                                <button type="submit" class="btn-ready">
                                    Ready for Pickup
                                </button>
                            </form>

                        @else

                            <span class="done">
                                Done
                            </span>

                        @endif

                        <a href="{{ route('owner.receipt', $order->id) }}"
                           class="receipt-btn">
                            Receipt
                        </a>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="empty">
                        No orders today yet.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

</body>
</html>