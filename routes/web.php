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
const CREATE_PATH = '/create';
const EDIT_PATH = '/edit/{id}';

Route::redirect('/', 'products');

Auth::routes();

Route::group([
    'prefix' => 'products',
], function () {
    Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get(CREATE_PATH, [App\Http\Controllers\ProductController::class, 'create'])->name('product-create');
    Route::post(CREATE_PATH, [App\Http\Controllers\ProductController::class, 'store'])->name('product-store');
    Route::get(EDIT_PATH, [App\Http\Controllers\ProductController::class, 'edit'])->name('product-edit');
    Route::put(EDIT_PATH, [App\Http\Controllers\ProductController::class, 'update'])->name('product-update');
    Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product-delete');
});

Route::group([
    'prefix' => 'categories',
    'middleware' => 'auth.admin',
], function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
    Route::get(CREATE_PATH, [App\Http\Controllers\CategoryController::class, 'create'])->name('category-create');
    Route::post(CREATE_PATH, [App\Http\Controllers\CategoryController::class, 'store'])->name('category-store');
    Route::get(EDIT_PATH, [App\Http\Controllers\CategoryController::class, 'edit'])->name('category-edit');
    Route::put(EDIT_PATH, [App\Http\Controllers\CategoryController::class, 'update'])->name('category-update');
    Route::delete('/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category-delete');
});
