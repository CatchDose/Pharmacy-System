<?php

namespace App\Http\Controllers;

use App\DataTables\RevenueDataTable;


class RevenueController extends Controller
{
    public function index(RevenueDataTable $dataTable)
    {

        return $dataTable->render('revenues.index');
    }

}
