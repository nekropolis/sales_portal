<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/sellers', [SellersController::class, 'listSeller'])->name('sellers');
    Route::post('/add-seller', [SellersController::class, 'addSeller'])->name('addSeller');
    Route::post('/update-seller', [SellersController::class, 'updateSeller'])->name('updateSeller');
});