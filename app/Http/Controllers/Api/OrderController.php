<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderapiRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * Summary of PostController
 */
class OrderController extends Controller
{
    public function index()
    {

        $orders = Auth::user()->order ?? Order::all();
        return OrderResource::collection($orders);
    }
    public function show(Order $order)
    {

        return new OrderResource($order);
    }
    
    public function store(StoreOrderapiRequest $request)
    {
        $order = Order::Create([

            'status'=> 1,
            'is_insured'=> $request->is_insured,
            'user_id'=> auth()->id() ?? 1,

        ]);

        if ($request->hasFile('prescription')){

            $files = $request->file('prescription');

            foreach ($files as $file) {

                $path = $file->store('order-'.$order->id , ['disk'=>'prescription']);

                Prescription::Create([
                    'order_id'=> $order->id ,
                    'path'=> $path,
                ]);
            }
        }

        return new OrderResource($order);
    }
    
    public function update(StoreOrderapiRequest $request, Order $order)
    {
        if ($order->status == 'New') {

            if ($request->hasFile('prescription')) {

                $directory = 'order-'.$order->id;
                Storage::disk('prescription')->deleteDirectory($directory);

                $files = $request->file('prescription');
    
                foreach ($files as $file) {
    
                    $path = $file->store('order-'.$order->id, ['disk'=>'prescription']);

                    $order->prescription()->delete();

                    Prescription::Create([
                        'order_id'=> $order->id ,
                        'path'=> $path,
                    ]);
                }
            }

            $order->update([
                'status'=> $request->status,
            ]);

            return new OrderResource($order);
        }

        return response()->json(['message'=>"your order is ".$order->status." you cant change it"] , 406);
    } 
}
