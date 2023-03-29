<?php

namespace App\Http\Controllers;

use App\DataTables\AddressesDataTable;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
class AddressController extends Controller
{
    public function index (AddressesDataTable $dataTable) {
        return $dataTable->render('addresses.index');
    }

    public function create() {
        return view('addresses.create');
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
            'area_id' => $request->area_id,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('addresses.index');
    }

    public function show(Address $address) { //Model pinding
        return view('addresses.show' , ['address'=> $address]);
    }

    public function edit(Address $address) {
        return view('addresses.edit' , ['address' => $address]);
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

    }
}
