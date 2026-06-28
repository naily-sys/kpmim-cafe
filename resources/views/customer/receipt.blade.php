<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #{{ $receipt->receipt_number }}</title>

    @vite([
        'resources/css/app.css',
        'resources/css/receipt.css',
        'resources/js/app.js'
    ])
</head>
<body>

    <div class="receipt">

        <div class="receipt-header">
            <h1>KPMIM Café</h1>
            <p>{{ $order->cafe->name }}</p>
            <div class="receipt-number">
                {{ $receipt->receipt_number }}
            </div>
        </div>

        <div class="info-row">
            <span>Customer</span>
            <span>{{ $order->user->name }}</span>
        </div>

        <div class="info-row">
            <span>Date</span>
            <span>{{ $order->created_at->format('d M Y') }}</span>
        </div>

        <div class="info-row">
            <span>Time</span>
            <span>{{ $order->created_at->format('h:i A') }}</span>
        </div>

        <div class="info-row">
            <span>Status</span>
            <span>{{ ucfirst($order->status) }}</span>
        </div>

        <hr class="divider">

        <div class="items-section">
            @foreach($order->orderItems as $item)
                <div class="item-row">
                    <span>
                        {{ $item->menuItem->name }} x{{ $item->quantity }}
                    </span>
                    <span>
                        RM {{ number_format($item->price * $item->quantity, 2) }}
                    </span>
                </div>
            @endforeach
        </div>

        <div class="total-row">
            <span>Total</span>
            <span>
                RM {{ number_format($receipt->total_amount, 2) }}
            </span>
        </div>

        <div class="receipt-footer">
            <p>Thank you for your order!</p>
            <p>Please collect at the counter when ready.</p>
        </div>

        <div class="actions">
            <a href="{{ route('customer.order.history') }}"
               class="btn btn-back">
                ← Back
            </a>

            <button onclick="window.print()"
                    class="btn btn-print">
                Print Receipt
            </button>
        </div>

    </div>

</body>
</html>