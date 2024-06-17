<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pembayaranController extends Controller
{
    public function index ()
    {
        $title = 'Travelocat';
        return view('homepage.pembayaran', compact('title'));
    }
}
