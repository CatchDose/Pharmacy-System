<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{

    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $data = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
        return view('statistics.index' , ['data'=>$data]);
    }
}
