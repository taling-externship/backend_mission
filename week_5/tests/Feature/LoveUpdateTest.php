<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Love;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoveUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->article = Article::factory()->create();
        $this->signable = User::create(User::factory()->make()->makeVisible('password')->toArray());
    }

    /** @test */
    public function test_cant_increase_love_count_without_login()
    {
        $cnt = 5;
        Love::factory($cnt, ['article_id' => $this->article->id])->create();

        $this->post($this->article->path . '/love')
            ->assertStatus(302);

        $this->assertDatabaseCount('loves', $cnt);
        $this->assertDatabaseMissing('loves', [
            'article_id' => $this->article->id,
            'user_id' => $this->signable->id,
        ]);
    }

    /** @test */
    public function test_success_increase_count_with_login()
    {
        $cnt = 5;
        Love::factory($cnt, ['article_id' => $this->article->id])->create();

        $this->actingAs($this->signable)
            ->post($this->article->path . '/love')
            ->assertStatus(302);

        $this->assertDatabaseCount('loves', $cnt + 1);
        $this->assertDatabaseHas('loves', [
            'article_id' => $this->article->id,
            'user_id' => $this->signable->id,
        ]);
    }

    /** @test */
    public function test_fail_cancel_love_without_login()
    {
        $cnt = 5;
        Love::factory($cnt, ['article_id' => $this->article->id])->create();
        Love::factory([
            'article_id' => $this->article->id,
            'user_id' => $this->signable->id
        ])->create();

        $this->delete($this->article->path . '/love/' . $this->article->myLoved)
            ->assertStatus(405);

        $this->assertDatabaseCount('loves', $cnt + 1);
        $this->assertDatabaseHas('loves', [
            'article_id' => $this->article->id,
            'user_id' => $this->signable->id,
        ]);
    }

    /** @test */
    public function test_success_cancel_love_with_login()
    {
        $cnt = 5;
        Love::factory($cnt, ['article_id' => $this->article->id])->create();
        Love::factory([
            'article_id' => $this->article->id,
            'user_id' => $this->signable->id
        ])->create();

        $this->actingAs($this->signable)->delete($this->article->path . '/love/' . $this->article->myLoved->id)
            ->assertStatus(302);

        $this->assertDatabaseCount('loves', $cnt);
        $this->assertDatabaseMissing('loves', [
            'article_id' => $this->article->id,
            'user_id' => $this->signable->id,
        ]);
    }
}
