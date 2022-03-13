<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\Auth\Email\PasswordResetLinkJob;
use App\Jobs\Auth\Email\VerificationNotificationJob;

class ApiAuthService
{
    public function store(array $params)
    {

        $user = User::create([
            ...$params,
            'password' => Hash::make($params['password']),
        ]);

        VerificationNotificationJob::dispatch($user);

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

        $user = User::where('email', $params['email'])->first();

        return response()->json([
            ...$user->toArray(),
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function reset_password_link()
    {
        PasswordResetLinkJob::dispatch(request()->only('email'));

        return response()->json([
            'result' => 'Sent.',
            'message' => 'But you should double check if the email was really sent. When the email receiving spends too much minutes(over 10 min), contact us.',
        ]);
    }
}
