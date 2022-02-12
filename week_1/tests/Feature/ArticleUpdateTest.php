<?php

namespace Tests\Feature;

use App\Models\Article;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_edit()
    {
        $article = Article::factory(1)->create();

        $response = $this->get('/article/1/edit');

        $response->assertStatus(200);
        $response->assertViewHas('article', $article->first());
        $response->assertViewIs('articles.form');
    }

    public function test_update_success()
    {
        $prev = Article::create([
            'title' => 'before',
            'body' => 'before',
        ]);

        $response = $this->patch("/article/{$prev->id}", [
            'title' => 'after',
            'body' => 'after',
        ]);

        $after = Article::find($prev->id);

        if ($prev->title === $after->title || $prev->body === $after->body) {
            throw new Exception('data is not modified');
        }

        $response->assertStatus(302);

        $response = $this->get('/article/1');
        $response->assertSee('after');
    }
}
