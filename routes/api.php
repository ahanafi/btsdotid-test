<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('shopping', ShoppingController::class)->except(['create', 'edit']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/users', [UserController::class, 'index']);
});

Route::post('/users/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/users/signin', [AuthController::class, 'signin'])->name('signin');
