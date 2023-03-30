<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\DataTables\PharmaciesDataTable;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Area;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PharmaciesDataTable $dataTable)
    {
        return $dataTable->render('pharmacy.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();

        return view("pharmacy.create", ["areas" => $areas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacyRequest $request)
    {

        $data = $request->validated();
        // dd($data);
        // dd($request->validated());
        $user = User::create([
            "name" => $data["name"], "email" => $data["email"], "national_id" => $data["national_id"], "date_of_birth" => $data["date_of_birth"],
            "gender" => $data["gender"], "phone" => $data["phone"],
            "avatar_image" => "asdasd",
            "password" => Hash::make(
                $data["password"]
            )
        ]);
        $Pharmacy = Pharmacy::create([
            "name" => $data["pharmacy_name"],
            "priority" => $data["priority"],
            "area_id" => $data["area_id"],
            "owner_id" => $user["id"]
        ]);
        $user->update(["pharmacy_id" => $Pharmacy->id]);
        $user->assignRole("pharmacy");
        return Redirect::route('pharmacies.show', $Pharmacy->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)

    {
        if (Auth::user()->hasRole("admin")) {

            return view("pharmacy.show", ["pharmacy" => $pharmacy]);
        }

        if (Auth::user()->hasRole(["pharmacy", "doctor"]) && Auth::user()->pharmacy_id == $pharmacy->id) {
            return view("pharmacy.show", ["pharmacy" => $pharmacy]);
        }
        abort(403, "You Are Not Authorized To View This Page");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pharmacy $pharmacy)
    {
        $areas = Area::all();
        return view("pharmacy.edit", ["pharmacy" => $pharmacy, "areas" => $areas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePharmacyRequest $request, Pharmacy $pharmacy)
    {

        $pharmacy->update($request->validated());

        return Redirect::route('pharmacies.show', $pharmacy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        return Redirect::route('pharmacies.show', $pharmacy);
    }
}
