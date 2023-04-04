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
        $clients = User::Role('client')->get();
        $doctors = User::Role('doctor')->get();
        $medicine = Medicine::all();
        $pharmacy = Pharmacy::all();

        return view('orders.create', ['users' => $clients, 'medicine' => $medicine, 'pharmacy' => $pharmacy, 'doctors' => $doctors]);
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

        // $url = route('test');
        // $totalPrice = $this::totalPrice($qty, $med);
        // $orderInfo = self::buildOrderInfo($med ,$qty );

        // Mail::to("hoda.yossiv@gmail.com")
        // ->queue(new ConfirmPriceMail($url, $orderInfo, $totalPrice));


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
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

        $users = User::all();
        $doctors = User::Role('doctor')->get();
        $pharmacy = Pharmacy::all();
        return view('orders.edit', ['order' => $order, 'users' => $users, 'pharmacy' => $pharmacy, 'doctors' => $doctors]);
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

            'is_insured' => $data['is_insured'],
            // 'pharmacy_id'=>$data['pharmacy_id'],
            'user_id' => $data['user_id'],

        ]);

        return to_route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if (auth()->user()->hasRole('admin')) {
            $order->delete();
        }
        return to_route('orders.index');
    }

    /**
     * assign medicine to new orders.
     */

    public function assign(StoreOrderRequest $request, Order $order)
    {


        $size = count($request->med);
        $request->validate([
            'qty[]' => 'size:' . $size,
        ]);
        $med = $request->med;
        $qty = $request->qty;
        self::createOrderMedicine($order, $med, $qty);

        $confirmUrl = url("stripe/$order->id");
        $cancelUrl = url("/orders/$order->id/cancel");

        $totalPrice = $this::totalPrice($qty, $med);
        $orderInfo = self::buildOrderInfo($med ,$qty);


        $mail =  Mail::to("omaralaa0989@gmail.com")
        ->queue(new ConfirmPriceMail(
            $confirmUrl
            ,$cancelUrl
            ,$orderInfo,
            $totalPrice));
        return to_route('orders.index');
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

    private static function buildOrderInfo ($medicines, $quantity)
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


    public function cancel(Order $order)
    {
        $order->update([
            'status' => 4
        ]);

        return response()->json([
            "messsage" => "thanks"
        ]);

    }
}
