<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderapiRequest;
use App\Http\Requests\Api\UpdateOrderapiRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


/**
 * Summary of OrderController
 */



class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orders = Auth::user()->order ?? Order::all();
        return OrderResource::collection($orders);
    }

    /**
    * Show the form for creating a new resource.
    */
    public function show(Order $order)
    {

        return new OrderResource($order);
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(StoreOrderapiRequest $request)
    {
        $order = Order::Create([

            'status'=> 1,
            'is_insured'=> $request->is_insured,
            'user_id'=> auth()->id() ?? 1,

        ]);

        $files = $request->file('prescription');

        foreach ($files as $file) {

            $path = $file->store('order-'.$order->id , ['disk'=>'prescription']);

            Prescription::Create([
                'order_id'=> $order->id ,
                'path'=> $path,
            ]);
        }

        return new OrderResource($order);
    }

    /**
    * update current resource in storage.
    */
    public function update(UpdateOrderapiRequest $request, Order $order)
    {
        if ($order->status == 'New') {

            if ($request->hasFile('prescription')){

                $directory = 'order-'.$order->id;
                Storage::disk('prescription')->deleteDirectory($directory);

                $order->prescription()->delete();
                $files = $request->file('prescription');

                foreach ($files as $file) {

                    $path = $file->store('order-'.$order->id, ['disk'=>'prescription']);

                    Prescription::Create([
                        'order_id'=> $order->id ,
                        'path'=> $path,
                    ]);
                }
            }

            $order->update([
                'status'=> $request->status,
                'is_insured'=> $request->is_insured,
            ]);

            return new OrderResource($order);
        }

        return response()->json(['message'=>"your order is ".$order->status." you cant change it"] , 406);
    }
}
