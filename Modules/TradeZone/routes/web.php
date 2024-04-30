<?php

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

Route::group([], function () {
    Route::resource('tradezone', TradeZoneController::class)->names('tradezone');
});
