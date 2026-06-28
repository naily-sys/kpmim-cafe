<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cafe;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $cafes = Cafe::all();
        $totalSales = Order::where('status', 'completed')->sum('total_price');
        $totalOrders = Order::count();
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(total_price) as total')
            ->where('status', 'completed')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.dashboard', compact('cafes', 'totalSales', 'totalOrders', 'monthlySales'));
    }

    public function report(Request $request)
    {
        $cafes = Cafe::all();
        $selectedCafe = $request->cafe_id ?? 'all';
        $selectedMonth = $request->month ?? now()->month;
        $selectedYear = $request->year ?? now()->year;

        $query = Order::with('cafe', 'user', 'orderItems.menuItem')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear);

        if ($selectedCafe !== 'all') {
            $query->where('cafe_id', $selectedCafe);
        }

        $orders = $query->latest()->get();
        $totalSales = $orders->sum('total_price');
        $totalOrders = $orders->count();

        return view('admin.report', compact(
            'cafes', 'orders', 'totalSales',
            'totalOrders', 'selectedCafe',
            'selectedMonth', 'selectedYear'
        ));
    }
}