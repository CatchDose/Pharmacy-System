<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAddressRequest;
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
        $userAddresses = User::find($userId)->addresses;
        $hasMain = false;
        foreach ($userAddresses as $userAddress) {
            if ( $userAddress->is_main == 'Yes') {
                $hasMain = true;
                $request->is_main = 0 ;
                break;
            }
        }
        if ( !$hasMain ){
            $request->is_main = 1;
        }
        Address::create([
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main' => $request->is_main,
            'area_id' => $request->area,
            'user_id' => Auth::user()->id
        ]);

    }

    public function show (Address $address) {
        if (!$address->id){
            return response()->json(["message" => "This User does not have any addresses"],404);
        }
        else {
            return $address;
        }
    }

    public function update (Address $address , UpdateAddressRequest $request){

        if(!$address->id) {
            return response()->json(["message" => "This Address does not exists"],404);
        }
        else {
            $userId = Auth::user()->id;
            $userAddresses = User::find($userId)->addresses;
            $hasMain = false;
            foreach ($userAddresses as $userAddress) {
                if ( $userAddress->is_main == 'Yes') {
                    $hasMain = true;
                    $request->is_main = 0 ;
                    break;
                }
            }
            if ( !$hasMain ){
                $request->is_main = 1;
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
        if (!$address->id) {
            return response()->json(["message" => "This address does not exists for this user"],404);
        }
        else{
            $address->delete();
        }
    }
}
