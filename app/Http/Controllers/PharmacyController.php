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

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PharmaciesDataTable $dataTable)
    {
        // dd($dataTable);
        $model = Pharmacy::all()->first();
        // dd($model->action);
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
        $user = User::create([
            "name" => $data["name"], "email" => $data["email"], "national_id" => $data["national_id"], "date_of_birth" => now(),
            "gender" => $data["gender"], "phone" => $data["phone"],
            "avatar_image" => $data["avatar_image"],
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
        return Redirect::route('pharmacies.show', $Pharmacy->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)

    {
        return view("pharmacy.show", ["pharmacy" => $pharmacy]);
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
        $pharmacy->save();
        $owner = $pharmacy->owner;
        $owner->update($request->validated());
        $owner->save();
        return view("pharmacy.show", ["pharmacy" => $pharmacy]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return Redirect::route('pharmacies.index');
    }
}
