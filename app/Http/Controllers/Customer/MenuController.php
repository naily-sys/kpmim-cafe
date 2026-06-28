<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use App\Models\MenuItem;

class MenuController extends Controller
{
    public function index(Cafe $cafe)
    {
        $foodItems = MenuItem::where('cafe_id', $cafe->id)
            ->where('category', 'food')
            ->where('is_available', true)
            ->get();

        $beverageItems = MenuItem::where('cafe_id', $cafe->id)
            ->where('category', 'beverage')
            ->where('is_available', true)
            ->get();

        return view('customer.menu', compact('cafe', 'foodItems', 'beverageItems'));
    }
}