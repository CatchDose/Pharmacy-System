<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return view("pharmacy.index", ["pharmacies" => $pharmacies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pharmacy.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        return view("pharmacy.show");
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

        return view("pharmacy.edit", ["pharmacy" => $pharmacy]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {

        return view("pharmacy.show", ["pharmacy" => $pharmacy]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacy)
    {
        return view("pharmacy.show", ["pharmacy" => $pharmacy]);
    }
}
