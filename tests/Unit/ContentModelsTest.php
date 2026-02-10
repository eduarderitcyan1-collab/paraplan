<?php

namespace Tests\Unit;

use App\Models\Block;
use App\Models\BlockItem;
use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_block_and_items_relations_work(): void
    {
        $user = User::factory()->create();
        $block = Block::factory()->create(['created_by' => $user->id]);
        $item = BlockItem::factory()->create(['block_id' => $block->id, 'created_by' => $user->id]);

        $this->assertTrue($block->items->contains($item));
        $this->assertIsArray($item->payload);
    }

    public function test_user_role_helper_and_gallery_relation_context(): void
    {
        $admin = User::factory()->admin()->create();
        $gallery = GalleryItem::factory()->create(['created_by' => $admin->id]);

        $this->assertTrue($admin->isAdmin());
        $this->assertSame($admin->id, $gallery->creator->id);
    }
}
