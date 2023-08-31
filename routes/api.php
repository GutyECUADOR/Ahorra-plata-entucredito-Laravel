<?php

use App\Http\Controllers\API\AvatarController;
use App\Http\Controllers\API\DiasInversionController;
use App\Http\Controllers\API\InversionController;
use App\Http\Controllers\API\TipoInversionController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/userdata', [AuthController::class, 'userData'])->middleware('auth:sanctum');

// API Inversion 
Route::apiResource('/inversion', InversionController::class)->middleware('auth:sanctum'); 
Route::apiResource('/tiposinversion', TipoInversionController::class)->middleware('auth:sanctum');
Route::apiResource('/diasinversion', DiasInversionController::class)->middleware('auth:sanctum');
Route::post('/avatar', [AvatarController::class, 'store'])->middleware('auth:sanctum');;