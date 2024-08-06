<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Localizations\Http\Controllers\LocalizationsController;

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
    Route::get('/localizations', [LocalizationsController::class, 'list'])->name('localizations');
    Route::get('/localizations-table', [LocalizationsController::class, 'getLocalizationsTable'])->name('getLocalizationsTable');
    Route::post('/create-localization', [LocalizationsController::class, 'create'])->name('createLocalization');
    Route::post('/update-localization', [LocalizationsController::class, 'update'])->name('updateLocalization');
    Route::post('/delete-localization', [LocalizationsController::class, 'delete'])->name('deleteLocalization');
});
