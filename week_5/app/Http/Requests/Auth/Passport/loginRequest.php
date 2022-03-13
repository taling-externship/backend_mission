<?php

namespace App\Http\Requests\Auth\Passport;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ];
    }
}
