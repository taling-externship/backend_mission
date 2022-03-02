<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'article_id' => Article::count() ? Article::all()->random()->id : Article::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ];
    }
}
