<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\ClientsController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function() {

    Route::patch('auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('v1')->group(function () {
        Route::resource('client', ClientsController::class);
    });

});

Route::prefix('v1/auth')->group(function() {

    Route::post('login', [AuthController::class, 'login'])->name('login');

});
