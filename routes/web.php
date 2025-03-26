<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/fetch-products', [ProductController::class, 'fetchProducts']);
