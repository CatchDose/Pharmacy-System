<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Mail\ConfirmPrice;
use App\Mail\ConfirmPriceMail;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\User;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Rules\SameArraySize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        if(!cache()->has("users"))
            cache(["users" => User::Role('client')->get()]);

        $doctors = User::Role('doctor')->get();

        $medicine = Medicine::all();
        $pharmacy = Pharmacy::all();

        return view('orders.create', ['users' => cache('users'), 'medicine' => $medicine, 'pharmacy' => $pharmacy, 'doctors' => $doctors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        $data = $request->all();
        $userId = User::all()->where('name', $data['userName'])->first()->id;
        $pharmacyId = Pharmacy::all()->where('name', $data['PharmacyName'])->first()->id;

        $med = $data['med'];
        $qty = $data['qty'];

        $order = Order::Create([
            'status' => 3,
            'pharmacy_id' => $pharmacyId,
            'user_id' => $userId,
            'is_insured' => $data['insured'],
        ]);

        self::createOrderMedicine($order, $med, $qty);

        $confirmUrl = url("stripe/$order->id");
        $cancelUrl = url("/orders/$order->id/cancel");

        $totalPrice = $this::totalPrice($qty, $med);
        $orderInfo = self::buildOrderInfo($med ,$qty);


          Mail::to("omaralaa0989@gmail.com")
        ->queue(new ConfirmPriceMail(
            $confirmUrl
            ,$cancelUrl
            ,$orderInfo,
            $totalPrice));

        return to_route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $medicine = Medicine::all();
        $prescriptions = $order->prescription;
        return view('orders.show', ['order' => $order, 'medicines' => $medicine, 'prescriptions' => $prescriptions]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Order $order)
    {

        if ($order->status == 'Processing') {

            $order->update([

                'status' => '4',
            ]);

        }

        return to_route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if( !auth()->user()->hasRole('admin')){
            return response()->json([
                'error' => "sorry only the admins are allowed delete Orders.",
            ], 200);
        }
        $order->delete();
        return response()->json([
            'success' => "you deleted this Order successfully.",
        ], 200);
    }

    /**
     * assign medicine to new orders.
     */

    public function assign(StoreOrderRequest $request, Order $order)
    {
        $med = $request->med;
        $qty = $request->qty;
        self::createOrderMedicine($order, $med, $qty);

        $confirmUrl = url("stripe/$order->id");
        $cancelUrl = url("/orders/$order->id/cancel");

        $totalPrice = $this::totalPrice($qty, $med);
        $orderInfo = self::buildOrderInfo($med,$qty);


        Mail::to("omaralaa0989@gmail.com")
        ->queue(new ConfirmPriceMail(
            $confirmUrl
            ,$cancelUrl
            ,$orderInfo,
            $totalPrice
        ));
        return to_route('orders.index');
    }


    /**
     * change order status to cancelled.
     */
    public function cancel(Order $order)
    {
        if($order->status === "Waiting"){
            $order->update([
                'status' => 4
            ]);
        }

        return response()->json([
            "message" => "Your order cancelled successfully, thanks for using our app"
        ]);

    }

    /**
    * change order status to delivered.
    */
    public function delivered(Order $order)
    {
        $order->update([
            'status' => 6
        ]);

        return to_route('orders.index');
    }


    private static function buildOrderInfo($medicines, $quantity)
    {
        $orderInfo = [];
        foreach ($medicines as $index => $medicine) {
            $medicine = Medicine::find($medicine);
            $orderInfo[] = [
                'medicine' => $medicine->name,
                'quantity'=> $quantity[$index],
                'price'=> $medicine->price * $quantity[$index],
            ];
        }
        return $orderInfo ;
    }

    private static function totalPrice($qty, $medicines)
    {
        $total = 0;

        foreach ($medicines as $index => $medicine) {

            $price = Medicine::find($medicine)->price;
            $total = $total + ($price * $qty[$index]);
        }

        return $total;
    }

    private static function createOrderMedicine($order, $med, $qty)
    {

        foreach ($med as $key => $value) {

            $order->medicines($value)->attach($value, ['quantity' => $qty[$key]]);
        }

        $order->update([

            'status' => 3,
            'doctor_id' => auth()->user()->hasRole('doctor')  ? auth()->id() : null,
        ]);
    }
}
