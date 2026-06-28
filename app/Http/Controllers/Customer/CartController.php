<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        return view('customer.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $menuItem = MenuItem::findOrFail($request->menu_item_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$menuItem->id])) {
            $cart[$menuItem->id]['quantity']++;
        } else {
            $cart[$menuItem->id] = [
                'name'     => $menuItem->name,
                'price'    => $menuItem->price,
                'quantity' => 1,
                'image'    => $menuItem->image,
                'cafe_id'  => $menuItem->cafe_id,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', $menuItem->name . ' added to cart!');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->menu_item_id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared!');
    }
}