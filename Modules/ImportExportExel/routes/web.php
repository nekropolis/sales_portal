<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\ImportExportExel\Http\Controllers\exelPriceTradeController;
use Modules\ImportExportExel\Http\Controllers\exelProductsController;

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
    Route::get('products-export', [exelProductsController::class, 'export'])->name('products.export');
    Route::post('products-import', [exelProductsController::class, 'import'])->name('products.import');

    Route::get('price-trade-export', [exelPriceTradeController::class, 'export'])->name('priceTrade.export');
});