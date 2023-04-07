<?php

namespace App\Http\Controllers;

use App\Http\Resources\RevenueResource;
use App\Http\Services\RevenueService;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected RevenueService $revenueService)
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(auth()->user()->hasRole("admin")){
            $dashboardData=$this->getAdminDashboardData();
        }
        if(auth()->user()->hasRole("pharmacy")){
            $dashboardData=$this->getPharmacyDashboardData();
        }
        return view('index',$dashboardData??[]);
    }


    public function getAdminDashboardData()
    {
        $total_orders = Order::count();
        $new_orders = Order::where("status", "new")->count();
        $clients = User::whereHas("roles", function (Builder $query) {
            $query->where('name', 'client');
        })->distinct()->count();
        $sumRevenues = 0;
        foreach (Pharmacy::all() as $pharmacy) {
            $sumRevenues += $this->revenueService->calcRevenue($pharmacy)["Total_Revenue"];
        }
        return ["total_orders"=>$total_orders,"new_orders"=>$new_orders,"clients"=>$clients,"sumRevenues"=> $sumRevenues];
    }


    public function getPharmacyDashboardData(){
        $pharmacy=auth()->user()->pharmacy;
        $revenue=new RevenueResource(Pharmacy::find($pharmacy->id));
        $sumRevenues=$this->revenueService->calcRevenue($pharmacy)["Total_Revenue"];
        $total_orders=$pharmacy->orders()->count();
        $new_orders=$pharmacy->orders()->where("status","new")->count();
        $clients=Order::where("pharmacy_id",$pharmacy->id)->whereHas("user",function ($user){
            $user->whereHas('roles',function ($role){
                $role->where('name','client');
            });
        })->distinct("user_id")->count();
        return ["total_orders"=>$total_orders,"new_orders"=>$new_orders,"clients"=>$clients,"sumRevenues"=> $sumRevenues];
    }
}




