<?php

namespace Tests\Feature;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArticleCreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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

    /** @test */
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

    /** @test */
    public function test_success_store_with_attachment()
    {
        Storage::fake('local');

        $this->assertDatabaseMissing('attachments', [
            'name' => 'test',
        ]);

        $file = UploadedFile::fake()->image('test.png', 300, 300);

        $this->actingAs($this->signable)->post('/article', [
            'title' => 'test',
            'body' => 'hello',
            'attachment' =>  $file,
        ]);

        $this->assertDatabaseHas('attachments', [
            'original_name' => 'test.png',
        ]);

        $stored = Attachment::where('article_id', 1)->first()->stored_name;

        Storage::disk('local')->assertExists('/attachment' . $stored);
    }
}
