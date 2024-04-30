<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Sellers\Http\Controllers\SellersController;

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
    Route::get('/sellers', [SellersController::class, 'listSeller'])->name('sellers');
    Route::post('/add-seller', [SellersController::class, 'addSeller'])->name('addSeller');
    Route::post('/update-seller', [SellersController::class, 'updateSeller'])->name('updateSeller');
});