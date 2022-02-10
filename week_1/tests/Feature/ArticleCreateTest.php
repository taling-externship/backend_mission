<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleCreateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_store()
    {
        $this->assertDatabaseMissing('articles', [
            'title' => 'test',
        ]);

        $response = $this->post('/article', [
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
        $response = $this->post('/article', [
            'title' => null,
            'body' => 'blind'
        ]);

        $this->assertDatabaseMissing('articles', [
            'title' => 'test',
        ]);

        $response->assertSessionHas('errors', function ($v) {
            return str_contains($v->get('title')[0], 'required');
        });
        $response->assertStatus(302);
    }

    public function test_success_store_with_tag()
    {
        $this->assertDatabaseMissing('tags', [
            'name' => 'test',
        ]);

        $this->post('/article', [
            'title' => 'test',
            'body' => 'hello',
            'tags' => ['test'],
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'test',
        ]);
    }
}
