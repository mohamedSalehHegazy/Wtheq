<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/'], function () {
    // UnAAuthorized Routes
    Route::post('login', [AuthController::class, 'login'])->name('user.login');
    Route::post('register', [AuthController::class, 'register'])->name('user.register');


    // Authorized Routes
    Route::group(['middleware' => ['auth:api']], function () {
        //Products
        Route::apiResource('products', ProductController::class);

        //Users
        Route::apiResource('users', UserController::class);
  
    });
});

Route::fallback(function () {
    return apiResponse(
        false,
        'Not Found !',
        404,
    );
});
