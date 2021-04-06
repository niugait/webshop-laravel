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

Auth::routes();

/**
 * Administrative Categories Routes
 */
Route::resource('categories', App\Http\Controllers\CategoryController::class)
    ->middleware(AUTH_ADMIN_PATH);

/**
 * Administrative Products Routes
 */
Route::resource('products', App\Http\Controllers\ProductController::class)
    ->except(['index', 'show'])
    ->middleware(AUTH_ADMIN_PATH);

/**
 * Administrative Coupons Routes
 */
Route::resource('coupons', App\Http\Controllers\CouponController::class)
    ->except(['show'])
    ->middleware(AUTH_ADMIN_PATH);

/**
 * Public Routes
 */
Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::get('/coupon/{coupon}', [App\Http\Controllers\CouponController::class, 'show'])->name('coupons.check');
