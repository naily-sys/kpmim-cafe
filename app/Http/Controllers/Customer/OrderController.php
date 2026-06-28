<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Notification;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $cafeId = collect($cart)->first()['cafe_id'];
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Create order
        $order = Order::create([
            'user_id'     => Auth::id(),
            'cafe_id'     => $cafeId,
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        // Create order items
        foreach ($cart as $menuItemId => $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'menu_item_id' => $menuItemId,
                'quantity'     => $item['quantity'],
                'price'        => $item['price'],
            ]);
        }

        // Generate receipt
        Receipt::create([
            'order_id'       => $order->id,
            'user_id'        => Auth::id(),
            'receipt_number' => 'RCP-' . strtoupper(uniqid()),
            'total_amount'   => $total,
        ]);

        // Notify the owner
        Notification::create([
            'user_id'  => Auth::id(),
            'order_id' => $order->id,
            'message'  => 'New order #' . $order->id . ' received!',
            'is_read'  => false,
            'type'     => 'owner',
        ]);

        // Clear cart
        session()->forget('cart');

        return redirect()->route('customer.order.status', $order->id);
    }

    public function status(Order $order)
    {
        $receipt = Receipt::where('order_id', $order->id)->first();
        return view('customer.order-status', compact('order', 'receipt'));
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('cafe', 'orderItems.menuItem', 'receipt')
            ->latest()
            ->get();

        return view('customer.order-history', compact('orders'));
    }
}