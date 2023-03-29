<?php

namespace App\Http\Controllers;
use App\DataTables\AreasDataTable;
use App\Http\Requests\StoreAreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;


class AreaController extends Controller
{
    public function index(AreasDataTable $dataTable)
    {
        return $dataTable->render('area.index');
    }

    public function create()
    {
        return view("area.create");
    }

    public function store(StoreAreaRequest $request)
    {

        Area::create($request->validated());

        return redirect()->route("areas.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        return view("area.show",["area" => $area]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        return view("area.edit",["area" => $area]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAreaRequest $request, Area $area)
    {
        $area->update($request->validated());

        return redirect()->route("areas.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route("areas.index");
    }
}


