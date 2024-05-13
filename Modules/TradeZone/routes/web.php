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
    Route::post('/form-trade-price', [TradeZoneController::class, 'formTradePrice'])->name('formTradePrice');

    Route::get('/rules-trade-price-table', [TradeZoneController::class, 'rulesTradePriceTable'])->name('rulesTradePriceTable');
    Route::post('/create-rule-trade-price', [TradeZoneController::class, 'createRuleTradePrice'])->name('createRuleTradePrice');
    Route::post('/edit-rule-trade-price', [TradeZoneController::class, 'editRuleTradePrice'])->name('editRuleTradePrice');
    Route::post('/delete-rule-trade-price', [TradeZoneController::class, 'deleteRuleTradePrice'])->name('deleteRuleTradePrice');
    Route::post('/set-currency-trade-price', [TradeZoneController::class, 'setCurrencyTradePrice'])->name('setCurrencyTradePrice');

});
