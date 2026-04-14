<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopController3;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route trang chủ - CHỈ GIỮ LẠI MỘT ROUTE
Route::get('/', [LaptopController3::class, 'index'])->name('trang-chu');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route tìm kiếm
Route::get('/tim-kiem', [LaptopController3::class, 'search'])->name('tim-kiem');

// Route theo thương hiệu
Route::get('/thuong-hieu/{id}', [LaptopController3::class, 'filterByBrand'])->name('thuong-hieu');

// Route chi tiết sản phẩm
Route::get('/san-pham/{id}', [ProductController::class, 'detail'])->name('san-pham');

// Route sắp xếp
Route::get('/sap-xep/{type}', [LaptopController3::class, 'sort'])->name('sap-xep');

Route::get('/laptop/list', 'App\Http\Controllers\LaptopController2@laptoplist')->name('laptoplist');
Route::post('/laptop/delete', 'App\Http\Controllers\LaptopController2@laptopdelete')->name('laptopdelete');
Route::get('/laptop/detail/{id}', 'App\Http\Controllers\LaptopController2@laptopdetail')->name('laptopdetail');

require __DIR__.'/auth.php';