<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeManager extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'like_manager';
    /**

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'articles_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];
}
