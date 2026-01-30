<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarakoController;

Route::get('/', [App\Http\Controllers\BarakoController::class, 'index'])->name('home');

// Barako Motorparts System routes (use controller)
Route::get('/dashboard', [BarakoController::class, 'dashboard'])->name('dashboard');
Route::get('/products', [BarakoController::class, 'products'])->name('products');
// Shop routes
Route::get('/product/{id}', [BarakoController::class, 'show'])->name('product.show');
Route::post('/cart/add', [BarakoController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [BarakoController::class, 'cart'])->name('cart');
Route::post('/cart/update', [BarakoController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{id}', [BarakoController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [BarakoController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [BarakoController::class, 'processPayment'])->name('checkout.process');
Route::get('/receipt', [BarakoController::class, 'receipt'])->name('receipt');
Route::get('/categories', [BarakoController::class, 'categories'])->name('categories');
Route::get('/orders', [BarakoController::class, 'orders'])->name('orders');
Route::get('/sales', [BarakoController::class, 'sales'])->name('sales');
