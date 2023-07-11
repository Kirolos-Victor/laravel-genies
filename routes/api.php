<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DeveloperController;
use App\Http\Controllers\API\ProjectController;
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
        Route::get('/{developer}', [DeveloperController::class, 'show']);
        Route::post('/create', [DeveloperController::class, 'store']);
        Route::put('/{developer}', [DeveloperController::class, 'update']);
        Route::delete('/{developer}', [DeveloperController::class, 'destroy']);
    });
    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/create', [ProjectController::class, 'store']);
        Route::put('/{project}', [ProjectController::class, 'update']);
        Route::delete('/{project}', [ProjectController::class, 'destroy']);
    });
});
