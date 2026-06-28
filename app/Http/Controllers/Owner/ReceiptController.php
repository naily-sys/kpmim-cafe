<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Receipt;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function show(Order $order)
    {
        // Make sure owner can only see receipts for their café
        if ($order->cafe_id !== Auth::user()->cafe_id) {
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

        return view('owner.receipt', compact('order', 'receipt'));
    }
}