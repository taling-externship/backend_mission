<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        "title" => "string",
        "body" => "string",
        "slug" => "string",
        "is_show" => "bool"]
    )]public function definition(): array
    {
        $title = $this->faker->name();
        $slug_id = mt_rand(100000000, 9999999999);
        return [
            "title" => $this->faker->name(),
            "body" => $this->faker->paragraph,
            "slug_id" => $slug_id,
            "slug" => $slug_id."-".Str::slug($title, "-"),
            "is_show" => true,
        ];
    }
}
