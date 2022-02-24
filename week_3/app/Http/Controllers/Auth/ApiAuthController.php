<?php

namespace App\Http\Controllers\Auth;

use App\Services\ApiAuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiRegisterRequest;
use App\Http\Requests\Auth\ApiSigninRequest;

class ApiAuthController extends Controller
{


    public function __construct(private ApiAuthService $service)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserSigninRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ApiRegisterRequest $request): JsonResponse
    {
        return $this->service->store($request->validated());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserSigninRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(ApiSigninRequest $request): JsonResponse
    {
        return $this->service->login($request->validated());
    }
}
