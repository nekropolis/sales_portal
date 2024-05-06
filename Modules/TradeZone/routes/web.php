<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\TradeZone\Http\Controllers\TradeZoneController;

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
    Route::get('/trade-price', [TradeZoneController::class, 'getTradePrice'])->name('getTradePrice');
    Route::get('/trade-price-settings', [TradeZoneController::class, 'settingsTradePrice'])->name('settingsTradePrice');
    Route::get('/trade-table', [TradeZoneController::class, 'getTable'])->name('getTable');
});
