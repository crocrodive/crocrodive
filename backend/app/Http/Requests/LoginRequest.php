<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        
        if (!Auth::attempt(
            $this->only('email', 'password') , true 
            /* remembre: true is critical, else the session would be flashed at the first redirection */
        )) {
            throw ValidationException::withMessages([
                'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
            ]);
        }
    }
}