<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->signable = User::create(User::factory()->make()->makeVisible('password')->toArray());
    }

    public function test_edit()
    {
        $article = Article::factory(['user_id' => $this->signable])->create();
        $this->actingAs($this->signable)
            ->get($article->path . "/edit")
            ->assertStatus(200)
            ->assertViewHas('article', $article)
            ->assertViewIs('articles.form');
    }

    public function test_update_success()
    {
        $prev = Article::create([
            'title' => 'before',
            'body' => 'before',
            'user_id' => $this->signable->id,
        ]);

        $this->actingAs($this->signable)
            ->patch($prev->path, [
                'title' => 'after',
                'body' => 'after',
            ])->assertStatus(302);

        $this->assertDatabaseHas('articles', [
            'title' => 'after',
            'body' => 'after',
        ]);

        $this->get('/article/1')->assertSee('after');
    }
}
