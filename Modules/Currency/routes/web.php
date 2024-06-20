<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Currency\Http\Controllers\CurrencyController;

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
    Route::get('/currency', [CurrencyController::class, 'list'])->name('currency');
    Route::get('/currency-table', [CurrencyController::class, 'getCurrencyTable'])->name('getCurrencyTable');
    Route::post('/create-currency', [CurrencyController::class, 'create'])->name('createCurrency');
    Route::post('/update-currency', [CurrencyController::class, 'update'])->name('updateCurrency');
    Route::post('/delete-currency', [CurrencyController::class, 'delete'])->name('deleteCurrency');
    Route::get('/upload-currency', [CurrencyController::class, 'uploadCurrency'])->name('uploadCurrency');
});