<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Prices\Http\Controllers\PricesController;


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
    Route::get('/price-parse/{price_id}', [PricesController::class, 'getPriceParse'])->name('getPriceParse');
    Route::get('/prices', [PricesController::class, 'listUploadedPrices'])->name('uploadedPrices');
    Route::post('/update-upload-price', [PricesController::class, 'updateUploadPrice'])->name('updateUploadPrice');
    Route::post('/delete-upload-price', [PricesController::class, 'deleteUploadPrice'])->name('deleteUploadPrice');
    Route::post('/parse-price', [PricesController::class, 'parsePrice'])->name('parsePrice');
    Route::post('/create-upload-price', [PricesController::class, 'createUploadPrice'])->name('createUploadPrice');
    Route::post('/update-file', [PricesController::class, 'fileUpdateUpload'])->name('updateFile');

    Route::post('/is-link', [PricesController::class, 'isLink'])->name('isLink');
    Route::post('/is_active', [PricesController::class, 'isActive'])->name('isActive');

    Route::get('/link-table', [PricesController::class, 'getTableLink'])->name('getTableLink');
    Route::get('/upload-price-table', [PricesController::class, 'getUploadPriceTable'])->name('getUploadPriceTable');

    Route::get('/search-product-price', [PricesController::class, 'searchProductPrice'])->name('searchProductPrice');
});