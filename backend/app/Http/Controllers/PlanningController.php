<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PlanningController extends Controller
{

    public function index(): View
    {
        return view('planning');
    }
}