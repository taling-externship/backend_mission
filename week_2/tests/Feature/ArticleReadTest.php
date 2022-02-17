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
        Article::factory()->create();

        $this->get('/article')
            ->assertStatus(200)
            ->assertSee(Article::latest()->with('tags')->paginate(15))
            ->assertDontSee(Article::factory()->make());
    }

    public function test_can_see_one_article()
    {
        $article = Article::factory()->create();

        $this->get($article->path)
            ->assertStatus(200)
            ->assertViewHas('article', $article);
    }
}
