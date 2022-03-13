<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Passport\loginRequest;
use App\Http\Requests\Auth\Passport\RegisterRequest;
use App\Http\Resources\Auth\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\AuthMailList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PassportController extends Controller
{
    use ApiResponseTrait;

    // TODO:: 회원가입
    public function register(RegisterRequest $registerRequest, User $user, AuthMailList $authMailList)
    {
        $registerRequest->validated();
        try {
            DB::beginTransaction();
            $user = $user->saveUser($registerRequest);
            $authMailList->addSandList($user->id, $authMailList->getTypeRegister());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return $e;
            return $this->error('$e->getMessage()', 500);
        }
        return $this->success('회원가입이 완료 되었습니다.', new UserResource($user), 200);
    }

    // TODO:: 로그인
    public function login(LoginRequest $loginRequest)
    {
        $loginRequest = $loginRequest->validated();
        if (Auth::attempt($loginRequest)) {
            if (Auth::user()->is_valid) {
                return $this->success('로그인에 성공 했습니다.', new UserResource(Auth::user()));
            }
            return $this->error('이메일 인증을 받아야 합니다..', 403);
        }
        return $this->error('아이디 또는 비밀번호가 일치하지 않습니다', 401);
    }

    public function verify($token)
    {
        $user = User::where('remember_token', $token)->first();
        $user->is_valid = true;
        $user->remember_token = Str::random('100');
        $user->save();

        if ($user) {
            return $this->success('회원 인증에 성공 했다. 나머지는 프론트가..', new UserResource($user));
        }

        return $this->error('토큰이 유효하지 않다.', 401);
    }
}
