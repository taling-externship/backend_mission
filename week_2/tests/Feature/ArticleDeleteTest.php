<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $user = User::factory()->create();
        Auth::login($user);

        Article::factory(3, ['user_id' => Auth::id()])->create();

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
