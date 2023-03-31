<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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


Route::post('/sanctum/token', [AuthController::class, 'getToken']);


Route::group(["middleware"=>"auth:sanctum"],function (){
    Route::put('/users/{user}',[UserController::class, 'update']);

    Route::get('/orders' , [OrderController::class , 'index']);
    Route::get('/orders/{order}' , [OrderController::class , 'show']);
    Route::post('/orders' , [OrderController::class , 'store']);
    Route::put('/orders/{order}' , [OrderController::class , 'update']);
    Route::put('/users/{user}',[UserController::class, 'update']);

});


