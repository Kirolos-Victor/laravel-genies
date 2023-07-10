<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DeveloperController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'developers'], function () {
        Route::get('/', [DeveloperController::class, 'index']);
        Route::post('/create', [DeveloperController::class, 'store']);
        Route::put('/{developer}', [DeveloperController::class, 'update']);
        Route::delete('/{developer}', [DeveloperController::class, 'destroy']);
    });
});
