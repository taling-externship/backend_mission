<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ko_KR');

        return [
            'title' => preg_replace("/(^[A-Z][^\s]+\s|\"|\'|\.)/", "", $faker->realText(rand(11, 40), rand(1, 5))),
            'body' => preg_replace("/(^[A-Z][^\s]+\s|\"|\'|\.)/", "", $faker->realText(rand(11, 200), rand(1, 5))),
            'user_id' => User::count() ? User::all()->random()->id : User::factory()->create(),
        ];
    }
}
