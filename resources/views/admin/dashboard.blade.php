<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite([
        'resources/css/app.css',
        'resources/css/admin-dashboard.css',
        'resources/js/app.js'
    ])
</head>
<body>

    <div class="header">
        <div>
            <h1>Admin Dashboard</h1>
            <p class="subtitle">KPMIM Café Ordering System</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.report') }}" class="btn">
                View Reports
            </a>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid">

        <div class="stat-card">
            <div class="number">
                {{ $totalOrders }}
            </div>
            <div class="label">
                Total Orders
            </div>
        </div>

        <div class="stat-card">
            <div class="number">
                RM {{ number_format($totalSales, 2) }}
            </div>
            <div class="label">
                Total Sales
            </div>
        </div>

        <div class="stat-card">
            <div class="number">
                {{ $cafes->count() }}
            </div>
            <div class="label">
                Total Cafés
            </div>
        </div>

    </div>

    <!-- Monthly Sales Summary -->
    <h2>Monthly Sales Summary</h2>

    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Year</th>
                <th>Total Sales</th>
            </tr>
        </thead>

        <tbody>
            @forelse($monthlySales as $sale)
                <tr>
                    <td>
                        {{ DateTime::createFromFormat('!m', $sale->month)->format('F') }}
                    </td>
                    <td>
                        {{ $sale->year }}
                    </td>
                    <td>
                        RM {{ number_format($sale->total, 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="empty">
                        No completed orders yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>