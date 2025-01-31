<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ManageController extends Controller
{
    public function index(Request $request): View
    {
        $user_value = User::getAllUserData();
        return view('manage', ["all_user_value" => $user_value]);
    }
}
