<?php

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;

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
    Route::get('/users', [UsersController::class, 'listUsers'])->name('listUsers');
    Route::get('/users-table', [UsersController::class, 'getTableUsers'])->name('getTableUsers');
    Route::post('/create-user', [RegistersUsers::class, 'create'])->name('createUser');
    Route::get('/user/{user_id}', [UsersController::class, 'showUser'])->name('showUser');
    Route::post('/edit-user/{user_id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::post('/delete-user', [UsersController::class, 'deleteUser'])->name('deleteUser');
});
