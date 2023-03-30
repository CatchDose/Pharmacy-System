<?php

namespace App\Http\Controllers;

use App\DataTables\AddressesDataTable;
use App\Models\Address;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
class AddressController extends Controller
{
    public function index (AddressesDataTable $dataTable) {
        return $dataTable->render('addresses.index');
    }

    public function create() {
        $users = User::all();
        $areas = Area::all();
        return view('addresses.create',['users' => $users , 'areas' => $areas]);
    }

    public function store(StoreAddressRequest $request) {
        $is_main = NULL;
        if ($request->is_main == 'yes') $is_main = 1 ;
        else $is_main = 0 ;
        Address::create([
           'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $is_main,
            'area_id' => $request->input('area'),
            'user_id' => $request->input('user')
        ]);

        return redirect()->route('addresses.index');
    }

    public function show(Address $address) { //Model pinding
        return view('addresses.show' , ['address'=> $address]);
    }

    public function edit(Address $address) {
        $users = User::all();
        $areas = Area::all();
        return view('addresses.edit' , ['address' => $address , 'users' => $users , 'areas' => $areas]);
    }

    public function update(UpdateAddressRequest $request, Address $address) {

        $address->update([
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $request->is_main,
            'area_id' => $request->area_id,
            'user_id' => $request->user_id
        ]);
    }

    public function destroy(Address $address) {
        $address->delete();
        return redirect()->route('addresses.index');
    }
}
