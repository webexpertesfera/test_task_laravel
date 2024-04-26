<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::put('profile/update', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::delete('profile/delete',[AuthController::class, 'deleteProfile'])->middleware('auth:sanctum');

/**
 * Only for LoggedIn User 
 */
Route::prefix('users')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [UserController::class, 'getAllPaginated']);
    Route::get('{id}', [UserController::class, 'find']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'delete']);
});