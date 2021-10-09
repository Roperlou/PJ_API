<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\MainController;
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

Route::apiResource('drivers', DriverController::class);

Route::get('/drivers/getTravelTime/{Point_1}|{Point_2}', [MainController::class, 'getTravelTimeForAll']);

Route::get('/drivers/{id}/getTravelTime/{Point_1}|{Point_2}', [MainController::class, 'getTravelTimeForOne']);
