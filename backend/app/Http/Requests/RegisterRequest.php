<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'],
            'numero_tel' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'regex:/^\d{5}$/'],
            'niveau_detenu' => ['required', 'integer'],
            'niveau_prepare' => ['required', 'integer', 'gt:niveau_detenu'],
            'num_licence' => ['required', 'string', 'max:255'],
            'date_certification_medical' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'lastname.required' => 'Le nom est obligatoire',
            'firstname.required' => 'Le prénom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être une adresse valide',
            'email.unique' => 'Cette adresse email est déjà utilisée',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
            'date_naissance.required' => 'La date de naissance est obligatoire',
            'date_naissance.date' => 'La date de naissance doit être une date valide',
            'numero_tel.required' => 'Le numéro de téléphone est obligatoire',
            'numero_tel.regex' => 'Le numéro de téléphone doit être un numéro valide',
            'role.required' => 'Le rôle est obligatoire',
            'adresse.required' => 'L\'adresse est obligatoire',
            'ville.required' => 'La ville est obligatoire',
            'code_postal.required' => 'Le code postal est obligatoire',
            'code_postal.regex' => 'Le code postal doit être un code valide',
            'niveau_detenu.required' => 'Le niveau détenu est obligatoire',
            'niveau_prepare.required' => 'Le niveau préparé est obligatoire',
            'niveau_prepare.gt' => 'Le niveau préparé doit être supérieur au niveau détenu',
            'num_licence.required' => 'Le numéro de licence est obligatoire',
            'date_certification_medical.required' => 'La date de certification médicale est obligatoire',
            'date_certification_medical.date' => 'La date de certification médicale doit être une date valide',
        ];
    }
}