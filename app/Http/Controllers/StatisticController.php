<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{

    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $total= 0 ;
        $gender = User::all()->groupBy('gender')->toArray(); // Males then females
        $ordersPerMonth= Order::whereIn('status',[5,6])
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->month;
            });
        $topUsers=Order::select("user_id as user",DB::raw('COUNT(user_id) as count'))->whereIn('status', [5,6])->groupby("user")->get();
        $topUsers=$topUsers->each(function ($user){
            return $user->user=User::find($user->user)->name;
        })->sortByDesc("count");

        foreach ($ordersPerMonth as $key=>$orders){
            foreach ($orders as $order){
                foreach ($order->medicines as $med){
                    $total+=$med->price*$med->pivot->quantity;
                }
                $revenue[$key] = $total;
            }
        }

        ksort($revenue);
        return view('statistics.index' , ['gender'=>$gender,"revenue"=>$revenue,"topUsers"=>$topUsers->sortByDesc("count")]);
    }
}
