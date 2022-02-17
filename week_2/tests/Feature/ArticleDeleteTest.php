<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleDeleteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->signable = User::create(User::factory()->make()->makeVisible('password')->toArray());
    }

    public function test_delete()
    {
        Article::factory(3, ['user_id' => $this->signable->id])->create();

        $deleteCandidate = Article::find(2);

        $this->actingAs($this->signable)->delete(route('article.destroy', 2))
            ->assertStatus(302)
            ->assertRedirect('article');

        $this->get(route('article.index'))
            ->assertViewMissing($deleteCandidate)
            ->assertSee(Article::find(1)->title)
            ->assertSee(Article::find(3)->title);

        $this->get(route('article.show', 1))
            ->assertStatus(200);

        $this->get(route('article.show', 2))
            ->assertStatus(404);
    }

    /** @test */
    public function test_failed_delete_without_login()
    {
        Article::factory(3, ['user_id' => $this->signable->id])->create();

        $deleteCandidate = Article::find(2);

        $this->delete(route('article.destroy', 2))
            ->assertStatus(403);

        $this->get(route('article.index'))
            ->assertSee($deleteCandidate->title);

        $this->get(route('article.show', 2))
            ->assertStatus(200);
    }
}
