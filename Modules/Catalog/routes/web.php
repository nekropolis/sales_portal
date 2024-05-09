<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Catalog\Http\Controllers\BrandsController;
use Modules\Catalog\Http\Controllers\CategoriesController;
use Modules\Catalog\Http\Controllers\CurrencyController;
use Modules\Catalog\Http\Controllers\MarginController;
use Modules\Catalog\Http\Controllers\ProductsController;

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

    Route::get('/brands', [BrandsController::class, 'list'])->name('brands');
    Route::post('/create-brand', [BrandsController::class, 'create'])->name('createBrand');
    Route::post('/update-brand', [BrandsController::class, 'update'])->name('updateBrand');
    Route::post('/delete-brand', [BrandsController::class, 'delete'])->name('deleteBrand');

    Route::get('/categories', [CategoriesController::class, 'list'])->name('categories');
    Route::post('/create-category', [CategoriesController::class, 'create'])->name('createCategory');
    Route::post('/update-category', [CategoriesController::class, 'update'])->name('updateCategory');
    Route::post('/delete-category', [CategoriesController::class, 'delete'])->name('deleteCategory');

    Route::get('/currency', [CurrencyController::class, 'list'])->name('currency');
    Route::post('/create-currency', [CurrencyController::class, 'create'])->name('createCurrency');
    Route::post('/update-currency', [CurrencyController::class, 'update'])->name('updateCurrency');
    Route::post('/delete-currency', [CurrencyController::class, 'delete'])->name('deleteCurrency');
    Route::get('/upload-currency', [CurrencyController::class, 'uploadCurrency'])->name('uploadCurrency');

    Route::get('/margin', [MarginController::class, 'list'])->name('margin');
    Route::post('/create-margin', [MarginController::class, 'create'])->name('createMargin');
    Route::post('/update-margin', [MarginController::class, 'update'])->name('updateMargin');
    Route::post('/delete-margin', [MarginController::class, 'delete'])->name('deleteMargin');
});
