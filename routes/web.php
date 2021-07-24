<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AdminController::class, 'index'])->name('admin.login');
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'admin_auth'], function() {

    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('admin/category/create', [CategoryController::class, 'category_create'])->name('admin.createCategory');
    Route::post('admin/category/save', [CategoryController::class, 'store_category'])->name('category.save');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit_category']);
    Route::put('admin/category/edit/{id}', [CategoryController::class, 'update_category']);
    //Route::get('admin/category/delete/{id}', [CategoryController::class, 'destroy_category']);
    Route::delete('admin/category/delete/{id}', [CategoryController::class, 'destroy_category']);

    Route::get('admin/coupon', [CouponController::class, 'index'])->name('admin.coupon');
    Route::get('admin/coupon/create', [CouponController::class, 'coupon_create'])->name('admin.createCoupon');
    Route::post('admin/coupon/save', [CouponController::class, 'store_coupon'])->name('coupon.save');
    Route::get('admin/coupon/edit/{id}', [CouponController::class, 'edit_coupon']);
    Route::put('admin/coupon/edit/{id}', [CouponController::class, 'update_coupon']);
    //Route::get('admin/coupon/delete/{id}', [CouponController::class, 'destroy_coupon']);
    Route::delete('admin/coupon/delete/{id}', [CouponController::class, 'destroy_coupon']);

    Route::get('admin/size', [SizeController::class, 'index'])->name('admin.size');
    Route::get('admin/size/create', [SizeController::class, 'size_create'])->name('admin.createSize');
    Route::post('admin/size/save', [SizeController::class, 'store_size'])->name('size.save');
    Route::get('admin/size/edit/{id}', [SizeController::class, 'edit_size']);
    Route::put('admin/size/update/{id}', [SizeController::class, 'update_size']);
    //Route::get('admin/size/delete/{id}', [SizeController::class, 'destroy_size']);
    Route::delete('admin/size/delete/{id}', [SizeController::class, 'destroy_size']);

    Route::get('admin/color', [ColorController::class, 'index'])->name('admin.color');
    Route::get('admin/color/create', [ColorController::class, 'color_create'])->name('admin.createColor');
    Route::post('admin/color/save', [ColorController::class, 'store_color'])->name('color.save');
    Route::get('admin/color/edit/{id}', [ColorController::class, 'edit_color']);
    Route::put('admin/color/update/{id}', [ColorController::class, 'update_color']);
    //Route::get('admin/color/delete/{id}', [ColorController::class, 'destroy_color']);
    Route::delete('admin/color/delete/{id}', [ColorController::class, 'destroy_color']);


    
    Route::get('admin/password_encript', [AdminController::class, 'updatePassword']);

    Route::get('admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');
    
});


