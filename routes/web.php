<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get("/test2", function () {
    dd(auth()->user('sanctum'));
    $orders = Order::where("status", 1)->get();
    foreach ($orders as $order) {
        $orderArea = $order->user->addresses()->where("is_main", 1)->first()->id;
        $order->pharmacy_id = Pharmacy::where("area_id", $orderArea)->orderby("priority", "desc")->first()->id;
        $order->save();
    }
})->name('test');


Route::get('/forgot/password' , [UserController::class , 'resetPasswordWithEmail'])->name('forgot');

Route::get('stripe/{order}', [StripePaymentController::class,'stripe'])->name("stripe.confirm");
Route::post('stripe/{order}', [StripePaymentController::class, 'stripePost'])->name('stripe.post');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();
    return Redirect()->route("index");
})->middleware(["auth", 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::group(["middleware" => ["auth", "role:admin|pharmacy|doctor", "logs-out-banned-user", "verified"]], function () {

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
    Route::post('/orders/{order}/assign', [OrderController::class, 'assign'])->name("orders.assign");
    Route::get('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name("orders.cancel");

    /*================================== start doctors route ================================= */

    Route::resource('doctors', DoctorController::class)->middleware('role:admin|pharmacy');
    /*================================== end doctors route ================================== */

    /*================================== start revenues route ================================= */
    Route::get("/revenues", [RevenueController::class, "index"])->name("revenues.index")->middleware('role:admin|pharmacy');;
    /*================================== end revenues route ================================== */

    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name("profiles.edit");
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name("profiles.update");
});

Auth::routes(['register' => false, 'verify' => true]);
