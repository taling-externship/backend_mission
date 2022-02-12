<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Board
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Board[] $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Board newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Board newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Board query()
 * @mixin \Eloquent
 */
class Board extends Model
{
    use HasFactory;

    /**
     * 공개 가능한 필드 정의
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'body',
        'slug',
        'created_at',
        'updated_at'
    ];


    /**
     * 1:N 관계 정의
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany('App\Models\Board');
    }
}
