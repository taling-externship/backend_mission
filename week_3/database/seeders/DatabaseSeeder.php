<?php

namespace Database\Seeders;

use App\Models\Article;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1,1000) as $index) {
            $title = $faker->realText($faker->numberBetween(10,20));
            Article::create([
                'slug_id' => Str::uuid(),
                'slug' => strtolower(preg_replace('/[^a-zA-Z가-힣0-9]+/', '-', $title)),
                'title' => $title,
                'content' =>$faker->realText($faker->numberBetween(100,200)),
            ]);
        }
        // \App\Models\User::factory(10)->create();
    }
}
