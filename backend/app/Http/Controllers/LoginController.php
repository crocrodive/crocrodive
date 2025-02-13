<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {   
        return view('welcome');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}