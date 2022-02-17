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
            ->assertSee('lovesCount');
    }

    /** @test */
    public function test_anyone_can_see_love_count_at_article_detail_page()
    {
        $this->get($this->article->path)
            ->assertSee('lovesCount');
    }

    /** @test */
    public function test_can_see_love_my_loved_article_login_user()
    {
        $this->get('/article')
            ->assertSee('lovesCount')
            ->assertSee('include me');
    }

    /** @test */
    public function test_cant_see_love_my_loved_article_no_login_user()
    {
        $this->get($this->article->path)
            ->assertSee('lovesCount')
            ->assertDontSee('include me');
    }
}
