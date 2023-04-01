<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevenueController;
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


Route::group(["middleware" => ["auth","role:admin|pharmacy|doctor","logs-out-banned-user"]], function () {

    Route::get('/', [IndexController::class, "index"])->name("index");

    /* ================================== start pharmacies route ==============================*/
    Route::group(
        ["middleware" => ['role:admin']],
        function () {
            Route::get("/pharmacies", [PharmacyController::class, "index"])->name("pharmacies.index");
            Route::get("/pharmacies/create", [PharmacyController::class, "create"])->name("pharmacies.create");
            Route::post("/pharmacies", [PharmacyController::class, "store"])->name("pharmacies.store");
            Route::delete("/pharmacies/{pharmacy}", [PharmacyController::class, "destroy"])->name("pharmacies.destroy");

            Route::resource('users', UserController::class);
            Route::resource('areas', AreaController::class);

        }
    );
    Route::group(
        ["middleware" => ['role:admin|pharmacy']],
        function () {
            Route::get("/pharmacies/{pharmacy}", [PharmacyController::class, "show"])->name("pharmacies.show");
            Route::get("/pharmacies/{pharmacy}/edit", [PharmacyController::class, "edit"])->name("pharmacies.edit");
            Route::put("/pharmacies/{pharmacy}", [PharmacyController::class, "update"])->name("pharmacies.update");


            Route::put("/doctors/{doctor}/ban", [UserController::class, "ban"])->name("doctors.ban");
            Route::put("/doctors/{doctor}/unban", [UserController::class, "unban"])->name("doctors.unban");
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

    Route::resource('addresses', AddressController::class);
    Route::resource('orders', OrderController::class);

    /*================================== start doctors route ================================= */

    Route::resource('doctors', DoctorController::class)->middleware('role:admin|pharmacy');
    /*================================== end doctors route ================================== */

    /*================================== start revenues route ================================= */
    Route::get("/revenues", [RevenueController::class, "index"])->name("revenues.index")->middleware('role:admin|pharmacy');;
    /*================================== end revenues route ================================== */

    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name("profiles.edit");
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name("profiles.update");
});

Auth::routes(['register' => false]);
