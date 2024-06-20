<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Categories\Http\Controllers\CategoriesController;

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
    Route::get('/categories', [CategoriesController::class, 'list'])->name('categories');
    Route::get('/categories-table', [CategoriesController::class, 'getCategoriesTable'])->name('getCategoriesTable');
    Route::post('/create-category', [CategoriesController::class, 'create'])->name('createCategory');
    Route::post('/update-category', [CategoriesController::class, 'update'])->name('updateCategory');
    Route::post('/delete-category', [CategoriesController::class, 'delete'])->name('deleteCategory');
});