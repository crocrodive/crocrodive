<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sessions extends Controller
{
    public function index(){
        return view("sessions");
    }
}
