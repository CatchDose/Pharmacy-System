<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UpdateAddressRequest;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function index () {

        $userId = Auth::user()->id;
        $userAddresses = User::find($userId)->addresses;
        return $userAddresses;

    }

    public function store (StoreAddressRequest $request){

        $userId = Auth::user()->id;
        $previousAddressIsMain = Address::where('user_id',$userId)->where('is_main', 1)->first();
        if ( $request->input('is_main') == 1 && !empty($previousAddressIsMain) ) {
            $previousAddressIsMain->is_main = 0;
            $previousAddressIsMain->save();
        }
       $address= Address::create([
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $request->is_main,
            'area_id' => $request->area,
            'user_id' => Auth::user()->id
        ]);
return new AddressResource ($address);
    }

    public function show (Address $address) {
        if ( $address->user->id != auth()->user()->id ) {
            return response()->json(["message" => "This user does not have this address please provide a valid address id for this user"],404);
        }
        else {
            return $address;
        }
    }

    public function update (Address $address , UpdateAddressRequest $request){
        $userId = Auth::user()->id;
        if ( $address->user->id != $userId ) {
            return response()->json(["message" => "This user does not have this address please provide a valid address id for this user"],404);
        }
        else {
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
                'is_main' => $request->is_main,
                'area_id' => $request->area,
                'user_id' => $userId
            ]);

        }
    }

    public function destroy (Address $address) {
        if ( $address->user->id != auth()->user()->id ) {
            return response()->json(["message" => "This user does not have this address please provide a valid address id for this user"],404);
        }
        else{
            $address->delete();
        }
    }
}
