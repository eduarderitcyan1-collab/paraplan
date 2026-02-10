<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\BlockItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_can_create_block(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)
            ->post('/admin/blocks', [
                'name' => 'Отзывы',
                'code' => 'reviews',
                'display_order' => 1,
                'is_active' => 1,
                'schema_json' => json_encode(['required' => ['title', 'description']], JSON_THROW_ON_ERROR),
            ])
            ->assertRedirect('/admin/blocks');

        $this->assertDatabaseHas('blocks', ['code' => 'reviews', 'created_by' => $editor->id]);
    }

    public function test_editor_can_create_block_item_for_service_block(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);
        $block = Block::factory()->create(['code' => 'service', 'created_by' => $editor->id]);

        $this->actingAs($editor)
            ->post("/admin/blocks/{$block->id}/items", [
                'title' => 'Тандем-полет',
                'description' => 'Короткое описание услуги',
                'payload_json' => json_encode([
                    'image' => '/uploads/service.jpg',
                    'price' => '7000',
                    'button_url' => 'https://example.com/order',
                ], JSON_THROW_ON_ERROR),
            ])
            ->assertRedirect("/admin/blocks/{$block->id}/items");

        $this->assertDatabaseHas('block_items', ['block_id' => $block->id, 'title' => 'Тандем-полет']);
    }

    public function test_editor_cannot_manage_users(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)->get('/admin/users')->assertForbidden();
    }

    public function test_item_reorder_works(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $block = Block::factory()->create(['created_by' => $admin->id]);
        $first = BlockItem::factory()->create(['block_id' => $block->id, 'display_order' => 0, 'created_by' => $admin->id]);
        $second = BlockItem::factory()->create(['block_id' => $block->id, 'display_order' => 1, 'created_by' => $admin->id]);

        $this->actingAs($admin)
            ->postJson("/admin/blocks/{$block->id}/items/reorder", ['ordered_ids' => [$second->id, $first->id]])
            ->assertOk();

        $this->assertDatabaseHas('block_items', ['id' => $second->id, 'display_order' => 0]);
        $this->assertDatabaseHas('block_items', ['id' => $first->id, 'display_order' => 1]);
    }
}
