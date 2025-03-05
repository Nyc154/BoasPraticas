<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/comprar', [ProductController::class, 'index'])->name('comprar');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/adicionar', function () {
    return view('adicionar');
})->name('adicionar');

Route::get('/carrinho', function () {
    return view('carrinho');
})->name('carrinho');

Route::post('/save-cart', [CartController::class, 'saveCart'])->name('save-cart');
Route::get('/get-cart', [CartController::class, 'getCart'])->name('get-cart');
