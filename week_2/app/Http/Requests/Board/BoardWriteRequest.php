<?php

namespace App\Http\Requests\Board;

use App\Models\Board;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class BoardWriteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        'title' => 'string',
        'body' => 'string',
        'slug_id' => 'string',
        'slug' => 'string'
    ])] public function rules(): array
    {
        return [
            'title' => 'required|max:120',
            'body' => 'required|min:12',
            'slug_id' => 'required',
            'slug' => 'required'
        ];
    }

    #[ArrayShape([
        '*.required' => 'string',
        'title.max' => 'string',
        'body.min' => 'string'
    ])] public function messages(): array
    {
        return [
            '*.required' => ':attribute 를 작성해주세요.',
            'title.max' => '게시글 제목은 최대 120자입니다.',
            'body.min' => '게시글 내용은 최소 12자입니다.',
        ];
    }

    /**
     * 요청 들어온 데이터 초기 값 추가
     * @return void
     */
    protected function prepareForValidation()
    {
        $new_slug_id = $this->getUniqueSlugId();
        $slug_title = Str::slug(Str::of($this['title'])->trim(), '-');
        $this->merge([
            'slug_id' => $new_slug_id,
            'slug' => $new_slug_id . '-' . $slug_title,
        ]);
    }

    /**
     * 유니크한 Slug의 ID가 없을 경우 생성
     * @return int
     */
    private function getUniqueSlugId(): int
    {
        $slug_id = mt_rand(100000000, 9999999999);
        $slug = Board::where('slug_id', $slug_id)->count();
        if ($slug !== 0) {
            $this->getUniqueSlugId();
        }

        return $slug_id;
    }
}
