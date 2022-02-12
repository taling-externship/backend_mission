<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasFactory;

    /**
     * 공개 가능한 필드 정의
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'board_id',
        'alt',
        'src',
        'order',
        'created_at',
        'updated_at'
    ];
}
