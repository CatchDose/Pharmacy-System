<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UpdateAddressRequest;

class AddressController extends Controller
{
    public function show (User $user) {
        $addresses = $user->addresses;
        if ($addresses->isEmpty()){
            return response()->json(["message" => "This User does not have any addresses"],404);
        }
        else {
            return $addresses;
        }
    }

    public function update (Address $address , UpdateAddressRequest $request){

        if(!$address->id) {
            return response()->json(["message" => "This Address does not exists"],404);
        }
        else {
            $address->update($request->validated());
        }
    }

    public function destroy (Address $address) {
        if ($address->id) {
            $address->delete();
        }
        else{
            return response()->json(["message" => "This address does not exists for this user"],404);
        }
    }
}
