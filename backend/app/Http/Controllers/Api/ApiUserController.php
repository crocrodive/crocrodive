<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiLoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    public function login(ApiLoginRequest $request): JsonResponse {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw new AuthenticationException(
                'The provided credentials are incorrect.'
            );
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return new JsonResponse([
            'message' => 'success',
            'token' => $token,
        ]);
    }

    public function getCurrentUser(Request $request): User {
        return $request->user();
    }
}
