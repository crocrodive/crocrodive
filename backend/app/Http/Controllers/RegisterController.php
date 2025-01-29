<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'user_lastname' => $request->lastname,
            'user_firstname' => $request->firstname,
            'birthdate' => $request->birthdate,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'role' => $request->role,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'current_level' => $request->current_level,
            'prepared_level' => $request->prepared_level,
            'license_number' => $request->license_number,
            'medical_certification_date' => $request->medical_certification_date,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        

        return redirect()->route('login')
            ->with('success', 'Compte créé avec succès !');
    }
}