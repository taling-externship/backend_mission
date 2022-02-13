<?php

namespace App\Http\Requests\Board;

use App\Models\Board;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class BoardUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        "id" => "string",
        "title" => "string",
        "body" => "string",
        "slug_id" => "string",
        "slug" => "string"
    ])] public function rules(): array
    {
        return [
            "id" => "required|int",
            "title" => "required|max:120",
            "body" => "required|min:12",
            "slug_id" => "required",
            "slug" => "required"
        ];
    }

    #[ArrayShape([
        "*.required" => "string",
        "title.max" => "string",
        "body.min" => "string"
    ])] public function messages(): array
    {
        return [
            "*.required" => ":attribute 를 작성해주세요.",
            "title.max" => "게시글 제목은 최대 120자입니다.",
            "body.min" => "게시글 내용은 최소 12자입니다.",
        ];
    }

    /**
     * 요청 들어온 데이터 초기 값 추가
     * @return void
     */
    protected function prepareForValidation()
    {
        $board = Board::find($this['id']);
        $slug_title = Str::slug(Str::of($this['title'])->trim(), '-');
        $this->merge([
            "slug_id" => $board->slug_id,
            "slug" => $board->slug_id. "-". $slug_title,
        ]);
    }
}
