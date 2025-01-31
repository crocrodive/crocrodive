<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Role;
use App\Models\Town;
//Import enums
use App\Enum\Roles;
use App\Models\Level;
class ManageController extends Controller
{
    public function index(Request $request): View
    {
        //Get in session flash data
        $all_user_value  = User::getAllUserData();
        $password = session('password');
        $levels = Level::all();
        $roles = [Roles::ATTENDEE, Roles::INSTRUCTOR];
        $success = session('success');
        return view('manage', compact('all_user_value','levels', 'roles', 'success', 'password'));
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'phone' => ['required',
                'regex:/^0[1-9]([-. ]?[0-9]{2}){4}$/'], // Validation du format téléphone
            'zipcode' => ['required', 'regex:/^\d{5}$/'], // Validation du format code postal
            'city' => 'required',
            'address' => 'required',
            'licence' => [
                'required',
                'regex:/^[aA]-\d{2}-\d{6}$/', // Validation du format licence
            ],
            'birthdate' => 'required',
            'certif' => 'required',
            'role' => 'required',
            'level' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        
        
        // Création de l'utilisateur
        $user = User::create([
            'user_lastname' => $request->lastname,
            'user_firstname' => $request->firstname,
            'user_telephone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($password),
            'user_address' => $request->address,
            'user_postal_code' => $request->zipcode,
            'user_medical_cert_date' => $request->certif,
            'user_city' => $request->city,
            'user_birth_date' => $request->birthdate,
            'user_diving_license_number' => $request->licence,
            'role_id' => $request->role,
            'leve_id' => $request->level,
            'user_is_password_temporary' => 0,
            'user_diploma_date' => null,
        ]);

        
        
        // Enregistrer la session après la création
        if ($user) {
            session()->put('login', $request->email);
            session()->put('password', $password);
            session()->put('success', true);
        } else {
            session()->put('success', false);
        }

        return redirect()->route('manage')->with('success', session('success'));
    }
}