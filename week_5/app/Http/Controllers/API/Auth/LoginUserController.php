<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    use ApiResponseTrait;


    // TODO:: 정보 조회
    public function userInfo()
    {
        $user = Auth::user();
        return $this->success('유저 정보 드림', new UserResource($user), 200);
    }
}
