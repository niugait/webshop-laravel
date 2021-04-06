<?php

use Illuminate\Support\Facades\Auth;
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

const AUTH_ADMIN_PATH = 'auth.admin';
const CREATE_PATH = '/create';
const EDIT_PATH = '/edit/{id}';
const DELETE_PATH = '/delete/{id}';

Route::redirect('/', 'products');

Auth::routes();

Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::group([
    'prefix' => 'products',
    'middleware' => AUTH_ADMIN_PATH,
], function () {
    Route::get(CREATE_PATH, [App\Http\Controllers\ProductController::class, 'create'])->name('product-create');
    Route::post(CREATE_PATH, [App\Http\Controllers\ProductController::class, 'store'])->name('product-store');
    Route::get(EDIT_PATH, [App\Http\Controllers\ProductController::class, 'edit'])->name('product-edit');
    Route::put(EDIT_PATH, [App\Http\Controllers\ProductController::class, 'update'])->name('product-update');
    Route::delete(DELETE_PATH, [App\Http\Controllers\ProductController::class, 'delete'])->name('product-delete');
});

Route::group([
    'prefix' => 'categories',
    'middleware' => AUTH_ADMIN_PATH,
], function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
    Route::get(CREATE_PATH, [App\Http\Controllers\CategoryController::class, 'create'])->name('category-create');
    Route::post(CREATE_PATH, [App\Http\Controllers\CategoryController::class, 'store'])->name('category-store');
    Route::get(EDIT_PATH, [App\Http\Controllers\CategoryController::class, 'edit'])->name('category-edit');
    Route::put(EDIT_PATH, [App\Http\Controllers\CategoryController::class, 'update'])->name('category-update');
    Route::delete(DELETE_PATH, [App\Http\Controllers\CategoryController::class, 'delete'])->name('category-delete');
});

Route::group([
    'prefix' => 'coupons',
    'middleware' => AUTH_ADMIN_PATH,
], function () {
    Route::get('/', [App\Http\Controllers\CouponController::class, 'index'])->name('coupons');
    Route::get(CREATE_PATH, [App\Http\Controllers\CouponController::class, 'create'])->name('coupon-create');
    Route::post(CREATE_PATH, [App\Http\Controllers\CouponController::class, 'store'])->name('coupon-store');
    Route::get(EDIT_PATH, [App\Http\Controllers\CouponController::class, 'edit'])->name('coupon-edit');
    Route::put(EDIT_PATH, [App\Http\Controllers\CouponController::class, 'update'])->name('coupon-update');
    Route::delete(DELETE_PATH, [App\Http\Controllers\CouponController::class, 'delete'])->name('coupon-delete');
});
