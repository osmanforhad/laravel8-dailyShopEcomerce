<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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
    //Route::get('admin/category/delete/{id}', [CategoryController::class, 'destroy_category']);
    Route::delete('admin/category/delete/{id}', [CategoryController::class, 'destroy_category']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit_category']);
    Route::put('admin/category/edit/{id}', [CategoryController::class, 'update_category'])->name('category.update');


    
    Route::get('admin/password_encript', [AdminController::class, 'updatePassword']);

    Route::get('admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');
    
});


