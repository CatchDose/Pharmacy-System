<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignNewOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders=Order::where("status",1)->get();
        foreach($orders as $order){
            $orderArea=$order->user->addresses()->where("is_main",1)->first()->id;
            $order->pharmacy_id=Pharmacy::where("area_id",$orderArea)->orderby("priority","desc")->first()->id ?? 1;
            $order->status=2;
            $order->save();
        }
    }
}
