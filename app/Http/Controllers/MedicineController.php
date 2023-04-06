<?php

namespace App\Http\Controllers;

use App\DataTables\MedicinesDataTable;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MedicineUpdateRequest;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MedicinesDataTable $dataTable)
    {

        return $dataTable->render('medicines.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("medicines.create", ["Medicines" => Medicine::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicineUpdateRequest $request)
    {

        $medicine = Medicine::create($request->validated());
        return Redirect::route("medicines.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return view("medicines.show", ["medicine" => $medicine]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return view("medicines.edit", ["medicine" => $medicine, "Medicines" => Medicine::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicineUpdateRequest $request, Medicine $medicine)
    {
        $medicine->update($request->validated());
        return Redirect::route("medicines.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {

        if($medicine->orders()->count()){
            return response()->json([
                'error' => "you can't delete This Medicine This Medicine has Orders Assigned to this order.",
            ], 200);
        }
        $medicine->delete();
        return response()->json([
            'success' => "you deleted this Medicine successfully.",
        ], 200);
    }
}
