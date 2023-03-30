<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrdersDataTable $dataTable)
    {

        return $dataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $medicine = Medicine::all();
        $pharmacy = Pharmacy::all();
        return view('orders.create' ,['users'=>$users , 'medicine'=>$medicine , 'pharmacy'=>$pharmacy]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->all();

        $UserId = User::all()->where('name' , $data['userName'] )->first()->id;
        $DocId = User::all()->where('name' , $data['DocName'] )->first()->id;
        $PharmacyId = Pharmacy::all()->where('name' , $data['PharmacyName'] )->first()->id;
        
        $med = $data['med'];
        $qty = $data['qty'];
        
        // dd(Order::totalPrice($qty , $med));

        $order = Order::Create([
            'status'=> 1,
            'pharmacy_id'=> $PharmacyId,
            'user_id'=> $UserId,
            'doctor_id'=> $DocId,
            'is_insured'=> $data['insured'],

        ]);

        Order::createOrderMedicine($order , $med , $qty);

        return to_route('orders.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        
        return view('orders.show' , ['order' =>$order]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

        return view('orders.edit' , ['order' =>$order]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        
        
        // $order->delete();
        return to_route('orders.index');
    }
}
