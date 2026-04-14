<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
Route::get('/laptop/theloai/{id}', [HomeController::class, 'theoDanhMuc']);
Route::get('/laptop/{id}', [HomeController::class, 'chiTiet']);
Route::post('/cart/add', [HomeController::class, 'add'])->name('cart.add');