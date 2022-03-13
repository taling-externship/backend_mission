<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * user register method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|string|min:6',
        ]);

        if ($validator->fails())
        {
            return $this->sendError([], $validator->errors()->all());
        }

        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());

        $token = $user->createToken('myAppToken')->plainTextToken;
        $response = [
            'token' => $token,
            'user' => new UserResource($user),
        ];

        return $this->sendResponse($response);
    }
}
