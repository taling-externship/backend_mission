<?php

namespace Tests\Unit\Love;

use App\Models\Article;
use App\Models\Love;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;

class LoveServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->signable = User::create(User::factory()->make()->makeVisible('password')->toArray());
    }

    /** @test */
    public function test_love_service_can_store_love()
    {
        $this->assertDatabaseCount('loves', 0);

        $this->actingAs($this->signable);

        $article = Article::factory()->create();
        $repository = new \App\Repositories\LoveRepository(new Love());
        $service = new \App\Services\LoveService($repository);
        $return = $service->store($article);

        $this->assertDatabaseCount('loves', 1);
        $this->assertInstanceOf(RedirectResponse::class, $return);
        $this->assertEquals($return->headers->get('location'), route('article.show', $article->id));
    }

    /** @test */
    public function test_love_service_can_remove_love()
    {
        $love = Love::factory([
            'user_id' => $this->signable->id,
        ])->create();

        $this->assertDatabaseCount('loves', 1);

        $this->actingAs($this->signable);

        $repository = new \App\Repositories\LoveRepository(new Love());
        $service = new \App\Services\LoveService($repository);
        $return = $service->destroy($love->article, $love);

        $this->assertDatabaseCount('loves', 0);
        $this->assertInstanceOf(RedirectResponse::class, $return);
        $this->assertEquals($return->headers->get('location'), route('article.index'));
    }
}
