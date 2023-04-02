<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\User;
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
        $clients = User::Role('doctor')->get();
        $doctors = User::Role('doctor')->get();
        $medicine = Medicine::all();
        $pharmacy = Pharmacy::all();

        return view('orders.create',['users'=>$clients , 'medicine'=>$medicine , 'pharmacy'=>$pharmacy , 'doctors'=>$doctors]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->all();
        $userId = User::all()->where('name', $data['userName'])->first()->id;
        $docId = User::all()->where('name', $data['DocName'])->first()->id;
        $pharmacyId = Pharmacy::all()->where('name', $data['PharmacyName'])->first()->id;


        $med = $data['med'];
        $qty = $data['qty'];

        $order = Order::Create([
            'pharmacy_id'=> $pharmacyId,
            'user_id'=> $userId,
            'doctor_id'=> $docId,
            'is_insured'=> $data['insured'],

        ]);

        self::createOrderMedicine($order, $med, $qty);


        // send email to user to notify him by price and change status to waiting (3)
        // $totalprice = $this::totalPrice($qty, $med);
        // dd($totalprice);

        return to_route('orders.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $medicine = Medicine::all();
        $prescriptions = $order->prescription;
        return view('orders.show', ['order' =>$order , 'medicines'=>$medicine , 'prescriptions'=>$prescriptions]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

        $users = User::all();
        $doctors = User::Role('doctor')->get();
        $pharmacy = Pharmacy::all();
        return view('orders.edit', ['order' =>$order ,'users'=>$users , 'pharmacy'=>$pharmacy , 'doctors'=>$doctors]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrderRequest $request, Order $order)
    {

        $data = $request->all();

        if (isset($data['status'])) {

            $order->status = $data['status'];
        }

        $order->update([

            'is_insured'=>$data['is_insured'],
            'pharmacy_id'=>$data['pharmacy_id'],
            'user_id'=>$data['user_id'],

        ]);

        return to_route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        $order->delete();
        return to_route('orders.index');
    }

    /**
     * assign medicine to new orders.
     */

     public function assign(StoreOrderRequest $request, Order $order)
     {
         
        $med = $request->med;
        $qty = $request->qty;
        self::createOrderMedicine($order, $med, $qty);

        // send email to user to notify him by price and change status to waiting (3)
        // $totalprice = $this::totalPrice($qty, $med);
        // dd($totalprice);

        return to_route('orders.index');
     }

    private static function totalPrice($qty, $med)
    {

        $total = 0;

        for ($x = 0; $x < count($med); $x++) {

            $price = Medicine::all()->where('name', $med[$x])->first()->price;
            $total = $total + ($price * $qty[$x]);
        }

        return $total;
    }

    private static function createOrderMedicine($order, $med, $qty)
    {

        foreach ($med as $key=>$value) {
            
            $order->medicines($value)->attach($value, ['quantity' => $qty[$key]]);

        }

        $order->update([
            
            'status'=>3,
            'doctor_id'=> auth()->user()->hasRole('doctor')  ? auth()->id : null,
        ]);
    }
}
