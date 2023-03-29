<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index () {
        return Address::all();
    }

    public function create() {

    }

    public function store(StoreAddressRequest $request) {

    }

    public function show(Address $address) {

    }

    public function edit(Address $address) {

    }

    public function update(UpdateAddressRequest $request, Address $address) {

    }

    public function destroy(Address $address) {

    }
}
