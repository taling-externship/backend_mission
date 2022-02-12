<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleDeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete()
    {
        Article::factory(3)->create();

        $deleteCandidate = Article::find(2);

        $response = $this->delete(route('article.destroy', 2));

        $response->assertStatus(302);

        $response = $this->get(route('article.index'));

        $response->assertViewMissing($deleteCandidate);
        $response->assertSee(Article::find(1)->title);
        $response->assertSee(Article::find(3)->title);

        $response = $this->get(route('article.show', 1));
        $response->assertStatus(200);

        $response = $this->get(route('article.show', 2));
        $response->assertStatus(404);
    }
}
