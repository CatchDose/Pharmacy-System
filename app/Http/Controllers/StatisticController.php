<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{

    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $data = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];

        $gender=["male"=>User::where('gender', 1)->count(),"female"=>User::where('gender', 2)->count()];
        $revenue=["1"=>500,"2"=>300,"3"=>1000,"4"=>1200,"5"=>900,"6"=>1500,"7"=>1600,"8"=>1200,"9"=>1400,"10"=>1600,"11"=>1900,"12"=>1700,];

        $topUsers=Order::select("user_id as user",DB::raw('COUNT(user_id) as count'))->whereIn('status', [5,6])->groupby("user")->get();

        $topUsers->each(function ($user){
            return $user->user=User::find($user->user)->name;

        });

        return view('statistics.index' , ['gender'=>$gender,"revenue"=>$revenue,"topUsers"=>$topUsers]);
    }
}
