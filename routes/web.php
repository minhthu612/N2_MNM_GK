<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController2;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';

// CÂU 4
Route::get('/gio-hang', [LaptopController2::class, 'cart'])->name('cart');

Route::post('/add-to-cart', [LaptopController2::class, 'addCart'])->name('cart.add');

Route::post('/remove-cart/{id}', [LaptopController2::class, 'removeCart'])->name('cart.remove');

Route::post('/order', [LaptopController2::class, 'order'])->name('cart.order');

