<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>

    @vite([
        'resources/css/app.css',
        'resources/css/admin-report.css',
        'resources/js/app.js'
    ])
</head>
<body>

    <div class="header">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="back">← Back to Dashboard</a>
            <h1>Sales Report</h1>
        </div>

        <button onclick="window.print()" class="btn-print">
         Print Report
        </button>
    </div>

    <!-- Filters -->
    <div class="filter-card">
        <h2>Filter Report</h2>

        <form method="GET" action="{{ route('admin.report') }}">
            <div class="filter-row">

                <div>
                    <label>Café</label>
                    <select name="cafe_id">
                        <option value="all"
                            {{ $selectedCafe == 'all' ? 'selected' : '' }}>
                            All Cafés
                        </option>

                        @foreach($cafes as $cafe)
                            <option value="{{ $cafe->id }}"
                                {{ $selectedCafe == $cafe->id ? 'selected' : '' }}>
                                {{ $cafe->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Month</label>
                    <select name="month">
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}"
                                {{ $selectedMonth == $m ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label>Year</label>
                    <input
                        type="number"
                        name="year"
                        value="{{ $selectedYear }}"
                        min="2024"
                        max="2030">
                </div>

                <div>
                    <button type="submit" class="btn">
                        Generate Report
                    </button>
                </div>

            </div>
        </form>
    </div>

    <!-- Summary Stats -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="number">{{ $totalOrders }}</div>
            <div class="label">Total Orders This Period</div>
        </div>

        <div class="stat-card">
            <div class="number">
                RM {{ number_format($totalSales, 2) }}
            </div>
            <div class="label">Total Sales This Period</div>
        </div>

    </div>

    <!-- Orders Table -->
    <h2>Order Details</h2>

    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Café</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>
                        <strong>#{{ $order->id }}</strong>
                    </td>

                    <td>{{ $order->user->name }}</td>

                    <td>{{ $order->cafe->name }}</td>

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
                        <span class="badge badge-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                    <td>
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">
                        No orders found for this period.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>