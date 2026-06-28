<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function show(Order $order)
    {
        // Make sure customer can only see their own receipt
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $receipt = Receipt::firstOrCreate(
            ['order_id' => $order->id],
            [
                'user_id'        => $order->user_id,
                'receipt_number' => 'RCP-' . strtoupper(uniqid()),
                'total_amount'   => $order->total_price,
            ]
        );

        return view('customer.receipt', compact('order', 'receipt'));
    }
}