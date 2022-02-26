<?php

namespace Tests\Unit\Article;

use App\Models\Article;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->signable = User::create(User::factory()->make()->makeVisible('password')->toArray());
    }

    /** @test */
    public function test_article_repository_could_return_paginate_list()
    {
        Article::factory(30)->create();

        $repository = new ArticleRepository(new Article());

        $results = $repository->getListWithPagination();

        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
        $this->assertEquals(15, $results->count());
        $this->assertInstanceOf(Article::class, $results->items()[0]);
    }

    /** @test */
    public function test_article_repository_could_store_article()
    {
        $repository = new ArticleRepository(new Article());
        $lorem_title = $this->faker()->sentence();
        $lorem_body = $this->faker()->paragraph();

        $this->actingAs($this->signable);

        $this->assertDatabaseMissing('articles', ['title' => $lorem_title]);

        $repository->store([
            'title' => $lorem_title,
            'body' => $lorem_body,
        ]);

        $this->assertDatabaseHas('articles', ['title' => $lorem_title]);
    }
}
