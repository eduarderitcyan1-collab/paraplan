<?php

namespace Tests\Feature;

use App\Models\Block;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_can_create_page(): void
    {
        $user = User::factory()->create(['role' => 'editor']);

        $this->actingAs($user)
            ->post('/admin/pages', [
                'title' => 'О компании',
                'slug' => 'about',
                'status' => 'published',
                'meta_title' => 'О компании',
                'meta_description' => 'Описание',
                'display_order' => 1,
            ])
            ->assertRedirect('/admin/pages');

        $this->assertDatabaseHas('pages', ['slug' => 'about', 'created_by' => $user->id]);
    }

    public function test_editor_cannot_manage_users(): void
    {
        $editor = User::factory()->create(['role' => 'editor']);

        $this->actingAs($editor)->get('/admin/users')->assertForbidden();
    }

    public function test_block_reorder_endpoint_changes_order(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $page = Page::factory()->create(['created_by' => $user->id]);
        $a = Block::factory()->create(['page_id' => $page->id, 'display_order' => 0, 'created_by' => $user->id]);
        $b = Block::factory()->create(['page_id' => $page->id, 'display_order' => 1, 'created_by' => $user->id]);

        $this->actingAs($user)
            ->postJson("/admin/pages/{$page->id}/blocks/reorder", ['ordered_ids' => [$b->id, $a->id]])
            ->assertOk();

        $this->assertDatabaseHas('blocks', ['id' => $b->id, 'display_order' => 0]);
        $this->assertDatabaseHas('blocks', ['id' => $a->id, 'display_order' => 1]);
    }
}
