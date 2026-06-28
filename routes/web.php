<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Auth\OwnerRegisterController;
use App\Http\Controllers\Auth\OwnerLoginController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ReceiptController;
use App\Http\Controllers\Owner\ReceiptController as OwnerReceiptController;

// Main page
Route::get('/', function () {
    if (Auth::check()) {
        return match(Auth::user()->role) {
            'customer' => redirect()->route('cafes.index'),
            'owner'    => redirect()->route('owner.dashboard'),
            'admin'    => redirect()->route('admin.dashboard'),
            default    => view('welcome'),
        };
    }
    return view('welcome');
});

// Customer auth routes
Route::get('/customer/login', function () {
    return view('auth.login');
})->name('customer.login');
Route::get('/customer/register', [CustomerRegisterController::class, 'create'])->name('customer.register');
Route::post('/customer/register', [CustomerRegisterController::class, 'store']);

// Owner auth routes
Route::get('/owner/select', function () {
    return view('owner.select-cafe');
})->name('owner.select');
Route::get('/owner/login', [OwnerLoginController::class, 'create'])->name('owner.login');
Route::post('/owner/login', [OwnerLoginController::class, 'store'])->name('owner.login.store');
Route::get('/owner/register', [OwnerRegisterController::class, 'create'])->name('owner.register');
Route::post('/owner/register', [OwnerRegisterController::class, 'store'])->name('owner.register.store');

// Customer protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cafes', [CafeController::class, 'index'])->name('cafes.index');

    // Menu
    Route::get('/cafes/{cafe}/menu', [CustomerMenuController::class, 'index'])->name('customer.menu');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('customer.cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('customer.cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('customer.cart.clear');

    // Orders
    Route::post('/order', [OrderController::class, 'store'])->name('customer.order.store');
    Route::get('/order/history', [OrderController::class, 'history'])->name('customer.order.history');
    Route::get('/order/{order}/status', [OrderController::class, 'status'])->name('customer.order.status');
    Route::get('/order/{order}/receipt', [ReceiptController::class, 'show'])->name('customer.receipt');
});

// Owner protected routes
// Owner protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    Route::post('/owner/order/{order}/preparing', [OwnerController::class, 'markPreparing'])->name('owner.order.preparing');
    Route::post('/owner/order/{order}/ready', [OwnerController::class, 'markReady'])->name('owner.order.ready');
    Route::get('/owner/order/{order}/receipt', [OwnerReceiptController::class, 'show'])->name('owner.receipt');

    // Menu routes
    Route::get('/owner/menu', [MenuController::class, 'index'])->name('owner.menu.index');
    Route::get('/owner/menu/create', [MenuController::class, 'create'])->name('owner.menu.create');
    Route::post('/owner/menu', [MenuController::class, 'store'])->name('owner.menu.store');
    Route::get('/owner/menu/{menuItem}/edit', [MenuController::class, 'edit'])->name('owner.menu.edit');
    Route::put('/owner/menu/{menuItem}', [MenuController::class, 'update'])->name('owner.menu.update');
    Route::delete('/owner/menu/{menuItem}', [MenuController::class, 'destroy'])->name('owner.menu.destroy');
});

// Admin protected routes
// Admin routes (no login required)
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/report', [AdminController::class, 'report'])->name('admin.report');

require __DIR__.'/auth.php';