<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validations = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8',
        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return jsonResponse(status: 401, message: 'Password or email incorrect');
        }

        return jsonResponse(
            data: [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => auth()->user()
            ],
            message: 'Login successful'
        );
    }

    public function register(CreateUserRequest $request): JsonResponse
    {
        $user = User::create($request->all());

        return jsonResponse(data: ['user' => $user->toArray()], status: 201, message: 'User registered successfully.');
    }

    public function getUser(): JsonResponse
    {
        $user = auth()->user();

        return jsonResponse(data: $user, status: 200, message: 'User successfully found!');
    }
}
