<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Board extends Model
{
    use HasFactory;
    use Searchable;

    public function getThumbImgUrlAttribute()
    {
        if ($this->img) {
            return asset('storage/' . $this->img);
        }
        
        return "https://via.placeholder.com/500/DFDFDF/000000?text=No%20image";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'boards_index';
    }
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }
}
