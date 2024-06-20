<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Brands\Http\Controllers\BrandsController;

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
    Route::get('/brands', [BrandsController::class, 'list'])->name('brands');
    Route::get('/brands-table', [BrandsController::class, 'getBrandsTable'])->name('getBrandsTable');
    Route::post('/create-brand', [BrandsController::class, 'create'])->name('createBrand');
    Route::post('/update-brand', [BrandsController::class, 'update'])->name('updateBrand');
    Route::post('/delete-brand', [BrandsController::class, 'delete'])->name('deleteBrand');
});
