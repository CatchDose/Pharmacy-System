<?php

namespace App\Http\Controllers;

use App\DataTables\AddressesDataTable;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index (AddressesDataTable $dataTable) {
        return $dataTable->render('addresses.index');
    }

    public function create() {
        return view('addresses.create');
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
