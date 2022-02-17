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
 * @property int $id
 * @property string $title 제목
 * @property string $body 내용
 * @property string $slug_id slug_id
 * @property string $slug 제목-Slug
 * @property int $is_show 공개 여부
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BoardFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Board whereUpdatedAt($value)
 */
class Board extends Model
{
    use HasFactory;
    private mixed $search;

    /**
     * 공개 가능한 필드 정의
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'body',
        'slug',
        'slug_id',
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
