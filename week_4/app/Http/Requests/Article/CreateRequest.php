<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateRequest extends FormRequest
{
    #[ArrayShape(['title' => "string[]", 'content' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
            'thumbnail' => ['required', 'image', 'max:2048'],
        ];
    }

    #[ArrayShape(["*.required" => "string", "max" => "string", "min" => "string"])]
    public function messages(): array
    {
        return [
            "*.required" => '빈칸을 채워주세요',
            "max" => '최대 :max자 까지 입력 할 수 있습니다.',
            "min" => '최소 :min 자 이상 입력해 주셔야 합니다.',

        ];
    }
}
