<?php

namespace App\Http\Controllers;

use App\DataTables\AddressesDataTable;
use App\Models\Address;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Support\Facades\Auth;

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
        $userId = $request->user;
        $previousAddressIsMain = Address::where('user_id',$userId)->where('is_main', 1)->first();
        if ( $request->input('is_main') == 1 && !empty($previousAddressIsMain) ) {
            $previousAddressIsMain->is_main = 0;
            $previousAddressIsMain->save();
        }
        Address::create([
           'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $request->is_main,
            'area_id' => $request->input('area'),
            'user_id' => $userId
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

        $userId = $address->user_id;
        $previousAddressIsMain = Address::where('user_id',$userId)->where('is_main', 1)->first();
        if ( $request->input('is_main') == 1 && !empty($previousAddressIsMain) ) {
            $previousAddressIsMain->is_main = 0;
            $previousAddressIsMain->save();
        }

        $address->update([
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $request->input('is_main'),
            'area_id' => $request->area,
            'user_id' => $request->user
        ]);
        return redirect()->route('addresses.index');
    }

    public function destroy(Address $address) {

        if($address->is_main=="Yes"){
            return response()->json([
                'error' => "you can't delete the Main Address of the user.",
            ], 200);
        }
        $address->delete();
        return response()->json([
            'success' => "you deleted this Address successfully.",
        ], 200);
    }
}
