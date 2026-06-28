<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        $cafeId = Auth::user()->cafe_id;

        $todayOrders = Order::where('cafe_id', $cafeId)
            ->whereDate('created_at', today())
            ->with('user', 'orderItems.menuItem')
            ->latest()
            ->get();

        $pendingOrders = $todayOrders->whereIn('status', ['pending', 'preparing']);

        return view('owner.dashboard', compact('todayOrders', 'pendingOrders'));
    }

    public function markPreparing(Order $order)
    {
        $order->update(['status' => 'preparing']);
        return redirect()->back()->with('success', 'Order #' . $order->id . ' marked as preparing!');
    }

    public function markReady(Order $order)
    {
        $order->update(['status' => 'ready']);

        // Notify the customer
        Notification::create([
            'user_id'  => $order->user_id,
            'order_id' => $order->id,
            'message'  => 'Your order #' . $order->id . ' is ready for pickup!',
            'is_read'  => false,
            'type'     => 'customer',
        ]);

        return redirect()->back()->with('success', 'Order #' . $order->id . ' is ready for pickup!');
    }
}