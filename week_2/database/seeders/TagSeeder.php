<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Bezhanov\Faker\ProviderCollectionHelper;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('en_US');
        ProviderCollectionHelper::addAllProvidersTo($faker);

        $articles = Article::factory(50)->create();

        foreach ($articles->random(40) as $article) {
            $tags = [];
            foreach (range(0, rand(0, 2)) as $_) {
                $tag = $faker->randomElement([
                    preg_replace("/[\s,\&,\/]/", '', $faker->department),
                    preg_replace("/[\s,\&,\/]/", '', $faker->deviceModelName),
                    preg_replace("/[\s,\&,\/]/", '', $faker->course),
                    preg_replace("/[\s,\&,\/]/", '', $faker->ingredient),
                    preg_replace("/[\s,\&,\/]/", '', $faker->medicine),
                    preg_replace("/[\s,\&,\/]/", '', $faker->scientist),
                    preg_replace("/[\s,\&,\/]/", '', $faker->creature),
                    preg_replace("/[\s,\&,\/]/", '', $faker->sport),
                    preg_replace("/[\s,\&,\/]/", '', $faker->city),
                    preg_replace("/[\s,\&,\/]/", '', $faker->country),
                ]);
                $createdTag = Tag::firstOrCreate([
                    'name' => $tag,
                ]);
                array_push($tags, $createdTag->id);
            }

            $article->tags()->syncWithoutDetaching($tags);
        }
    }
}
