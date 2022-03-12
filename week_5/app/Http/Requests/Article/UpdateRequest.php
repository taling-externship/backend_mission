<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateRequest extends FormRequest
{
    #[ArrayShape(['id' => "string[]", 'title' => "string[]", 'content' => "string[]", 'is_show' => "string[]"])]
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:articles,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
            'is_show' => ['required', 'boolean'],
        ];
    }

    #[ArrayShape(["*.required" => "string", "max" => "string", "min" => "string", "boolean" => "string", "exists" => "string"])]
    public function messages(): array
    {
        return [
            "*.required" => '빈칸을 채워주세요',
            "max" => '최대 :max자 까지 입력 할 수 있습니다.',
            "min" => '최소 :min 자 이상 입력해 주셔야 합니다.',
            "boolean" => 'boolean 타입을 입력해주셔아힙니다',
            "exists" => '존재하지 않는 게시글입니다.',
        ];
    }
}
