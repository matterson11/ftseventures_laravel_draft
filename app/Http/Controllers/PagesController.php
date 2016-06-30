<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{

    public function home()
    {
        $testing = ["Hello", "Goodbye", "Tara"];

        return view('main_page', compact('testing'));
    }

    public function dealing()
    {
        return view('dealings_page');
    }

    public function about()
    {
        return view('about');
    }
}
