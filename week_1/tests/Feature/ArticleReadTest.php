<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleReadTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_no_article_message()
    {
        $response = $this->get('/article');
        $this->view('articles.list', ['articles' => []])
            ->assertSee("No articles yet...");

        $response->assertStatus(200);
    }

    public function test_can_see_all_articles()
    {
        Article::factory(5)->create();

        $response = $this->get('/article');
        $articles = Article::latest()->with('tags')->paginate(15);

        $response->assertStatus(200);
        $response->assertViewHas('articles', $articles);
    }

    public function test_cat_see_one_article()
    {
        Article::create([
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph()
        ]);

        $response = $this->get('/article/1');
        $response->assertStatus(200);
        $response->assertViewHas('article', Article::find(1));
    }
}
