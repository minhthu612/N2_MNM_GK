<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopController3;
use App\Http\Controllers\LaptopController2;
use Illuminate\Support\Facades\Route;

// ================== TRANG CHỦ ==================
Route::get('/', [HomeController::class, 'index'])->name('trang-chu');

// ================== DASHBOARD ==================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ================== ADMIN ==================
Route::get('/laptop/list', 'App\Http\Controllers\LaptopController3@laptoplist')
    ->name('laptoplist');

Route::post('/laptop/delete', 'App\Http\Controllers\LaptopController3@laptopdelete')
    ->name('laptopdelete');

// ================== AUTH ==================
require __DIR__.'/auth.php';

// ================== GIỎ HÀNG (PHẢI LOGIN) ==================
Route::middleware('auth')->group(function () {

    // Xem giỏ hàng
    Route::get('/gio-hang', [LaptopController2::class, 'cart'])
        ->name('cart');

    // Thêm vào giỏ
    Route::post('/add-to-cart', [LaptopController2::class, 'addCart'])
        ->name('cart.add');

    // Xóa sản phẩm
    Route::post('/remove-cart/{id}', [LaptopController2::class, 'removeCart'])
        ->name('cart.remove');

    // Đặt hàng
    Route::post('/order', [LaptopController2::class, 'order'])
        ->name('cart.order');
});

// ================== SẢN PHẨM ==================

// Lọc theo danh mục
Route::get('/laptop/theloai/{id}', [HomeController::class, 'theoDanhMuc']);

// Chi tiết sản phẩm
Route::get('/laptop/{id}', [HomeController::class, 'chiTiet'])
    ->name('laptop.show');

// ================== TÌM KIẾM ==================
Route::get('/timkiem', [HomeController::class, 'timKiem']);