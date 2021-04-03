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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group([
    'prefix' => 'categories',
    'middleware' => 'auth.admin',
], function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
    Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category-create');
    Route::post('/create', [App\Http\Controllers\CategoryController::class, 'store'])->name('category-store');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
