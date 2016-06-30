<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;

class DealingController extends Controller
{
    public function dealing()
    {
        $buys = DB::table('dealings')->where('type', 'Buy')->orderBy('date', 'desc')->get();

        $sells = DB::table('dealings')->where('type', 'Sell')->orderBy('date', 'desc')->get();

        return view('dealings_page', compact('buys', 'sells'));
    }
}
