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

        $userAddresses = auth()->user()->addresses;

        return AddressResource::collection($userAddresses);

    }

    public function store (StoreAddressRequest $request){

        $previousAddressIsMain = Address::where('user_id', auth()->id())->where('is_main', 1)->first();

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
            'user_id' => auth()->id()
        ]);

        return response()->json([
            "message" => "Address created successfully",
            "data" => new AddressResource($address)
        ], 200);
    }

    public function show (Address $address) {
        if ( $address->user->id != auth()->user()->id ) {
            return response()->json(["message" => "This user does not have this address please provide a valid address id for this user"],404);
        }
        else {
            return new AddressResource($address);
        }
    }

    public function update (Address $address , UpdateAddressRequest $request){

        if ( $address->user->id != auth()->id() ) {
            return response()->json(["message" => "This user does not have this address please provide a valid address id for this user"],404);
        }
        else {

            $previousAddressIsMain = Address::where('user_id',auth()->id())->where('is_main', 1)->first();
            if ( $request->input('is_main') == 1 && !empty($previousAddressIsMain) ) {
                $previousAddressIsMain->is_main = 0;
                $previousAddressIsMain->save();
            }

            $address->update($request->validated());

            return response()->json([
                "message" => "Address updated successfully",
                "data" => new AddressResource($address)
            ],200);

        }
    }

    public function destroy (Address $address) {
        if ( $address->user->id != auth()->user()->id ) {
            return response()->json(["message" => "This user does not have this address please provide a valid address id for this user"],404);
        }
        else{
            $address->delete();
            return response()->json([
                "message" => "Address has been deleted successfully",
                "data" => new AddressResource($address)
            ],200);
        }
    }
}
