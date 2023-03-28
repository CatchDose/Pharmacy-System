<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $types = ["Tablet", "Capsule", "Injection", "Syrup"];
    return $types[array_rand($types)];
})->name("index");



Route::get("/pharmacies", [PharmacyController::class, "index"])->name("pharmacies.index");
Route::get("/pharmacies/create", [PharmacyController::class, "create"])->name("pharmacies.create");
Route::post("/pharmacies", [PharmacyController::class, "store"])->name("pharmacies.store");
Route::get("/pharmacies/{pharmacy}", [PharmacyController::class, "show"])->name("pharmacies.show");
Route::get("/pharmacies/{pharmacy}/edit", [PharmacyController::class, "edit"])->name("pharmacies.edit");
Route::put("/pharmacies/{pharmacy}", [PharmacyController::class, "update"])->name("pharmacies.update");
Route::delete("/pharmacies/{pharmacy}", [PharmacyController::class, "destroy"])->name("pharmacies.destroy");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
