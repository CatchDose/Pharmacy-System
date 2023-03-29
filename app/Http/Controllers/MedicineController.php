<?php

namespace App\Http\Controllers;

use App\DataTables\MedicinesDataTable;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        return Redirect::route('medicines.index');
    }
}
