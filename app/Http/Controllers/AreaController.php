<?php

namespace App\Http\Controllers;
use App\DataTables\AreasDataTable;
use App\Http\Requests\StoreAreaRequest;
use App\Models\Area;
use App\Models\Country;
use Illuminate\Http\Request;


class AreaController extends Controller
{
    public function index(AreasDataTable $dataTable)
    {
        return $dataTable->render('area.index');
    }

    public function create()
    {
        // $allareas=Area::where('country_id',818)->get();
        // $allareas=json_encode($allareas);
        // dd($allareas);
        $Countries_data=Country::all();
        // dd($Countries_data);
        return view("area.create",['countries'=>$Countries_data]);
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
        return view("area.index",["area" => $area]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        $Countries_data=Country::all();
        // dd($Countries_data);

        return view("area.edit",["area" => $area,'countries'=>$Countries_data]);
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
        if( $area->addresses()->count() && $area->pharmacies()->count() ){
            return response()->json([
                'error' => "you can't delete the Area of the user.",
            ], 200);
        }
        $area->delete();
        return response()->json([
            'success' => "you deleted this Address successfully.",
        ], 200);



    }

}


