<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\BlockItem;
use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_blocks_and_gallery(): void
    {
        $user = User::factory()->create();

        $block = Block::factory()->create([
            'name' => 'Почему мы',
            'code' => 'why_us',
            'is_active' => true,
            'created_by' => $user->id,
        ]);

        BlockItem::factory()->create([
            'block_id' => $block->id,
            'title' => 'Опыт',
            'payload' => ['icon' => '/uploads/icon.svg'],
            'created_by' => $user->id,
        ]);

        GalleryItem::factory()->create([
            'type' => 'photo',
            'url' => '/uploads/photo.jpg',
            'created_by' => $user->id,
        ]);

        $this->getJson('/api/blocks')
            ->assertOk()
            ->assertJsonPath('blocks.0.code', 'why_us')
            ->assertJsonPath('blocks.0.items.0.title', 'Опыт')
            ->assertJsonPath('gallery.photo.0.url', '/uploads/photo.jpg');
    }

    public function test_api_returns_single_block_by_code(): void
    {
        $user = User::factory()->create();
        $block = Block::factory()->create(['name' => 'Отзывы', 'code' => 'reviews', 'created_by' => $user->id]);
        BlockItem::factory()->create(['block_id' => $block->id, 'title' => 'Иван', 'created_by' => $user->id]);

        $this->getJson('/api/blocks/reviews')
            ->assertOk()
            ->assertJsonPath('code', 'reviews')
            ->assertJsonPath('items.0.title', 'Иван');
    }
}
