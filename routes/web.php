<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(["middleware" => "auth"], function () {

    Route::get('/', function () {
        return view("welcome");
    })->name("index");

    /* ================================== start pharmacies route ==============================*/
    Route::group(
        ["middleware" => ['role:admin']],
        function () {
            Route::get("/pharmacies", [PharmacyController::class, "index"])->name("pharmacies.index");
            Route::get("/pharmacies/create", [PharmacyController::class, "create"])->name("pharmacies.create");
            Route::post("/pharmacies", [PharmacyController::class, "store"])->name("pharmacies.store");
            Route::delete("/pharmacies/{pharmacy}", [PharmacyController::class, "destroy"])->name("pharmacies.destroy");
        }
    );
    Route::group(
        ["middleware" => ['role:admin|pharmacy']],
        function () {
            Route::get("/pharmacies/{pharmacy}/edit", [PharmacyController::class, "edit"])->name("pharmacies.edit");
            Route::put("/pharmacies/{pharmacy}", [PharmacyController::class, "update"])->name("pharmacies.update");
        }
    );
    Route::group(
        ["middleware" => ['role:admin|pharmacy|doctor']],
        function () {
            Route::get("/pharmacies/{pharmacy}", [PharmacyController::class, "show"])->name("pharmacies.show");
        }
    );

    /* ================================== end pharmacies route ==================================*/

    /* ================================== start v route ==============================*/
    Route::get("/medicines", [MedicineController::class, "index"])->name("medicines.index");
    Route::get("/medicines/create", [MedicineController::class, "create"])->name("medicines.create");
    Route::post("/medicines", [MedicineController::class, "store"])->name("medicines.store");
    Route::get("/medicines/{medicine}/edit", [MedicineController::class, "edit"])->name("medicines.edit");
    Route::put("/medicines/{medicine}", [MedicineController::class, "update"])->name("medicines.update");
    Route::delete("/medicines/{medicine}", [MedicineController::class, "destroy"])->name("medicines.destroy");

    /* ================================== end medicines route ==================================*/



    Route::get("/areas", [AreaController::class, "index"])->name("areas.index");
    Route::get("/areas/create", [AreaController::class, "create"])->name("areas.create");
    Route::post("/areas", [AreaController::class, "store"])->name("areas.store");
    Route::get("/areas/{area}", [AreaController::class, "show"])->name("areas.show");
    Route::get("/areas/{area}/edit", [AreaController::class, "edit"])->name("areas.edit");
    Route::put("/areas/{area}", [AreaController::class, "update"])->name("areas.update");
    Route::delete("/areas/{area}", [AreaController::class, "destroy"])->name("areas.destroy");



    Route::resource('users', UserController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('orders', OrderController::class);
});

Auth::routes();
