<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiAuthService
{
    public function store(array $params)
    {

        $user = User::create([
            ...$params,
            'password' => Hash::make($params['password']),
        ]);

        return response()->json([
            ...$user->toArray(),
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(array $params)
    {
        if (!auth()->attempt($params)) {
            return response()->json([
                'message' => 'Not Found Matched User',
                'error' => [
                    'credential' => 'invalid',
                ],
            ], 422);
        }

        return response()->json([
            'access_token' => User::where('email', $params['email'])->first()->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }
}
