<?php

namespace Tests\Unit;

use App\Models\Block;
use App\Models\Media;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_block_and_media_relations_work(): void
    {
        $user = User::factory()->create();
        $page = Page::factory()->create(['created_by' => $user->id]);
        $block = Block::factory()->create(['page_id' => $page->id, 'created_by' => $user->id, 'content' => ['text' => 'Hi']]);
        $media = Media::factory()->create(['block_id' => $block->id, 'uploaded_by' => $user->id]);

        $this->assertTrue($page->blocks->contains($block));
        $this->assertTrue($block->media->contains($media));
        $this->assertSame('Hi', $block->content['text']);
    }
}
