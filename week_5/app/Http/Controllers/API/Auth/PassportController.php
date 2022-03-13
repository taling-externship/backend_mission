<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Passport\loginRequest;
use App\Http\Requests\Auth\Passport\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
    use ApiResponseTrait;

    // TODO:: 회원가입
    public function register(RegisterRequest $registerRequest, User $user)
    {
        $registerRequest->validated();
        $user = $user->saveUser($registerRequest);
        return $this->success('회원가입이 완료 되었습니다.', new UserResource($user), 200);
    }

    // TODO:: 로그인
    public function login(LoginRequest $loginRequest)
    {
        $loginRequest = $loginRequest->validated();
        if (Auth::attempt($loginRequest)) {
            return $this->success('로그인에 성공 했습니다.', new UserResource(Auth::user()));
        }
        return $this->error('아이디 또는 비밀번호가 일치하지 않습니다', 401);
    }

    // TODO:: 정보 조회
    public function userInfo()
    {

    }

    // TODO:: 토큰 재발급
}
