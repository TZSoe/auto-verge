<?php

use Illuminate\Http\Request;
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

Route::post('auth/login', 'Api\Auth\LoginController@login');

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::apiResource('users', 'Api\UserController')->middleware('check-is-admin');

    Route::apiResource('services', 'Api\ServiceController')->middleware('check-is-admin');

    Route::apiResource('customers', 'Api\CustomerController');

    Route::apiResource('bookings', 'Api\BookingController');

    Route::patch('bookings/{booking}/paid', 'Api\BookingController@paid');
});