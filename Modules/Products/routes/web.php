<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductsController;

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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/products', [ProductsController::class, 'list'])->name('products');
    Route::get('/products-table', [ProductsController::class, 'getProductsTable'])->name('getProductsTable');
    Route::post('/create-product', [ProductsController::class, 'create'])->name('createProduct');
    Route::post('/update-product', [ProductsController::class, 'update'])->name('updateProduct');
    Route::post('/delete-product', [ProductsController::class, 'delete'])->name('deleteProduct');
});
