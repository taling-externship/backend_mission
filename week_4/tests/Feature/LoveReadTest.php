<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Love;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoveReadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->article = Article::factory()->create();
        $this->signable = User::create(User::factory()->make()->makeVisible('password')->toArray());
    }

    /** @test */
    public function test_anyone_can_see_love_count_at_list_page()
    {
        $this->get('/article')
            ->assertSee('loves-count');
    }

    /** @test */
    public function test_anyone_can_see_love_count_at_article_detail_page()
    {
        $this->get($this->article->path)
            ->assertSee('loves-count');
    }

    /** @test */
    public function test_can_see_my_loved_article_login_user()
    {
        Love::factory([
            'article_id' => $this->article->id,
            'user_id' => $this->signable->id,
        ])->create();
        $this->actingAs($this->signable)->get('/article')
            ->assertSee('loves-count')
            ->assertSee('include-me');
    }
}
