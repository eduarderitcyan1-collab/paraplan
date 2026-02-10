<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\Media;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_pages_returns_only_published(): void
    {
        $user = User::factory()->create();
        Page::factory()->create(['slug' => 'published-page', 'status' => 'published', 'created_by' => $user->id]);
        Page::factory()->create(['slug' => 'draft-page', 'status' => 'draft', 'created_by' => $user->id]);

        $response = $this->getJson('/api/pages');

        $response->assertOk()->assertJsonFragment(['slug' => 'published-page']);
        $response->assertJsonMissing(['slug' => 'draft-page']);
    }

    public function test_api_page_show_returns_blocks_and_media(): void
    {
        $user = User::factory()->create();
        $page = Page::factory()->create(['slug' => 'about', 'status' => 'published', 'created_by' => $user->id]);
        $block = Block::factory()->create(['page_id' => $page->id, 'type' => 'text', 'content' => ['text' => 'Добро пожаловать'], 'created_by' => $user->id]);
        Media::factory()->create(['block_id' => $block->id, 'type' => 'image', 'url' => '/uploads/banner.jpg', 'uploaded_by' => $user->id]);

        $this->getJson('/api/pages/about')
            ->assertOk()
            ->assertJsonPath('slug', 'about')
            ->assertJsonPath('blocks.0.type', 'text')
            ->assertJsonPath('blocks.0.media.0.url', '/uploads/banner.jpg');
    }
}
