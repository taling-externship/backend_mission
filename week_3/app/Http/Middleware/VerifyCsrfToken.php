<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * CSRF 사용 하려면 여기에 도메인을 추가 해야할듯합니다.
     * @var array<int, string>
     */
    protected $except = [
        'http://localhost:3000/*',
    ];
}
