<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\SellersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/price/{price_id}', [PricesController::class, 'getPrice'])->name('getPrice');
    Route::get('/prices', [PricesController::class, 'listPrices'])->name('prices');
    Route::post('/update-upload-price', [PricesController::class, 'updateUploadPrice'])->name('updateUploadPrice');
    Route::post('/delete-upload-price', [PricesController::class, 'deleteUploadPrice'])->name('deleteUploadPrice');
    Route::post('/parse-price', [PricesController::class, 'parsePrice'])->name('parsePrice');
    Route::post('/upload-file', [PricesController::class, 'fileUpload'])->name('fileUpload');
    Route::post('/update-file', [PricesController::class, 'fileUpdateUpload'])->name('updateFile');

    Route::get('/sellers', [SellersController::class, 'listSeller'])->name('sellers');
    Route::post('/add-seller', [SellersController::class, 'addSeller'])->name('addSeller');
    Route::post('/update-seller', [SellersController::class, 'updateSeller'])->name('updateSeller');
});