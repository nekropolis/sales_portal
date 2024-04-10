<?php

use Illuminate\Support\Facades\Route;
use Modules\Prices\app\Http\Controllers\PricesController;


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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/price/{price_id}', [PricesController::class, 'getPrice'])->name('getPrice');
    Route::get('/prices', [PricesController::class, 'listUploadedPrices'])->name('uploadedPrices');
    Route::post('/update-upload-price', [PricesController::class, 'updateUploadPrice'])->name('updateUploadPrice');
    Route::post('/delete-upload-price', [PricesController::class, 'deleteUploadPrice'])->name('deleteUploadPrice');
    Route::post('/parse-price', [PricesController::class, 'parsePrice'])->name('parsePrice');
    Route::post('/upload-file', [PricesController::class, 'fileUpload'])->name('fileUpload');
    Route::post('/update-file', [PricesController::class, 'fileUpdateUpload'])->name('updateFile');
});