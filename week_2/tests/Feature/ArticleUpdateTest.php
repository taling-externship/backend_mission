<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $user = User::factory()->create();
        $article = Article::factory(1, ['user_id' => $user->id])->create();

        Auth::loginUsingId($user->id);

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
            'user_id' => User::factory()->create()->id,
        ]);

        $response = $this->patch("/article/{$prev->id}", [
            'title' => 'after',
            'body' => 'after',
            'user_id' => User::factory()->create()->id,
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
