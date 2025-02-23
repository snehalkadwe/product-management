<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products/import-users', [ProductController::class, 'import'])->name('products.import');
Route::get('/products/export-products', [ProductController::class, 'export'])->name('products.export');
