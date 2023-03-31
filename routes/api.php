<?php

use App\Http\Controllers\Api\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/orders' , [OrderController::class , 'index']);
Route::get('/orders/{order}' , [OrderController::class , 'show']);
Route::post('/orders' , [OrderController::class , 'store']);
Route::put('/orders/{order}' , [OrderController::class , 'update']);