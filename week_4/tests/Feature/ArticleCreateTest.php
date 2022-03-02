<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleCreateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->signable = User::create(User::factory()->make()->makeVisible('password')->toArray());
    }

    public function test_success_store()
    {
        $this->assertDatabaseMissing('articles', [
            'title' => 'test',
        ]);

        $response = $this->actingAs($this->signable)->post('/article', [
            'title' => 'test',
            'body' => 'hello',
        ]);

        $this->assertDatabaseHas('articles', [
            'title' => 'test',
            'body' => 'hello',
        ]);

        $response->assertStatus(302);
    }

    public function test_fail_store_without_required()
    {
        $response = $this->actingAs($this->signable)->post('/article', [
            'title' => null,
            'body' => 'blind'
        ]);

        $this->assertDatabaseMissing('articles', [
            'title' => 'test',
        ]);

        $response->assertSessionHas('errors', function ($v) {
            return str_contains($v->get('title')[0], 'required');
        })->assertStatus(302);
    }

    /** @test */
    public function test_fail_store_without_login()
    {
        $this->get(route('article.create'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    public function test_success_store_with_tag()
    {
        $this->assertDatabaseMissing('tags', [
            'name' => 'test',
        ]);

        $this->actingAs($this->signable)->post('/article', [
            'title' => 'test',
            'body' => 'hello',
            'tags' => ['test'],
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'test',
        ]);
    }
}
