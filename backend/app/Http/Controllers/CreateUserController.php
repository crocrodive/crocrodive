<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Town;
//Import enums
use App\Enum\Roles;
use App\Models\Level;

class CreateUserController extends Controller
{

    //View
    public function index()
    {
        //Get in session flash data
        $password = session('password');
        $levels = Level::all();
        $roles = [Roles::ATTENDEE, Roles::INSTRUCTOR];
        $success = session('success');
        return view('create_user', compact('levels', 'roles', 'success', 'password'));
    }

    

    public function edit(Request $request, $id)
    {
        // Récupérer l'utilisateur avec l'id
        $user = User::find($id);
    
        // Vérifier si l'utilisateur existe
        if ($user) {
            // Mise à jour des informations
            $user->update([
                'user_lastname' => $request->lastname,
                'user_firstname' => $request->firstname,
                'user_telephone' => $request->phone,
                'user_postal_code' => $request->zipcode,
                'user_medical_cert_date' => $request->certif,
                'user_city' => $request->city,
                'user_birth_date' => $request->birthdate,
                'user_diving_license_number' => $request->licence,
                'role_id' => $request->role,
                'leve_id' => $request->level,
            ]);
    
            // Si la mise à jour est bien effectuée, mettre en session 'success_edit' à true
            session()->put('success_edit', true);
            return redirect()->route('create_user')->with('success_edit', true);
        } else {
            // Si l'utilisateur n'existe pas
            return redirect()->route('create_user')->with('success_edit', false);
        }
    }
    

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            // Supprimer l'utilisateur
            $user->delete();

            // Ajouter un message flash de succès
            session()->flash('success_message', 'L\'utilisateur a été supprimé avec succès.');
        } else {
            // Si l'utilisateur n'est pas trouvé
            session()->flash('error_message', 'Utilisateur non trouvé.');
        }

        // Rediriger vers la page des utilisateurs ou une autre page
        return redirect()->route('create_user'); // Change cette route en fonction de ta configuration
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

        return redirect()->route('create_user')->with('success', session('success'));
    }

}
