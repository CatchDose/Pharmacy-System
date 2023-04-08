<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\AddressController;
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

Route::post("/register",[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/email/verify/{id}/{hash}', [VerificationController::class,"verifyEmail"])->middleware(["auth:sanctum",'signed'])->name('api.verification.verify');

Route::post('/email/verification-notification', [VerificationController::class,"sendVerifyEmail"])->middleware(["auth:sanctum",'throttle:6,1'])->name('api.verification.send');

Route::group(["middleware"=>["auth:sanctum","verified"]],function (){


    Route::put('/users/{user}',[UserController::class, 'update']);

    Route::get('/addresses', [AddressController::class, 'index']);
    Route::get('/addresses/{address}',[AddressController::class, 'show']);
    Route::put('/addresses/{address}',[AddressController::class, 'update']);
    Route::post('/addresses',[AddressController::class , 'store']);
    Route::delete('/addresses/{address}',[AddressController::class, 'destroy']);

    Route::get('/orders' , [OrderController::class , 'index']);
    Route::get('/orders/{order}' , [OrderController::class , 'show']);
    Route::post('/orders' , [OrderController::class , 'store']);
    Route::put('/orders/{order}' , [OrderController::class , 'update']);

});


