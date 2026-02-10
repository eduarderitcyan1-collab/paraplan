<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function index(): JsonResponse
    {
        $pages = Page::query()
            ->where('status', 'published')
            ->orderBy('display_order')
            ->get(['title', 'slug', 'meta_title', 'meta_description']);

        return response()->json($pages);
    }

    public function show(string $slug): JsonResponse
    {
        $page = Page::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->with(['blocks.media'])
            ->firstOrFail();

        return response()->json([
            'title' => $page->title,
            'slug' => $page->slug,
            'meta_title' => $page->meta_title,
            'meta_description' => $page->meta_description,
            'blocks' => $page->blocks->map(function ($block) {
                return [
                    'type' => $block->type,
                    'content' => $block->content,
                    'media' => $block->media->map(fn ($item) => [
                        'type' => $item->type,
                        'url' => $item->url,
                        'alt_text' => $item->alt_text,
                    ])->values(),
                ];
            })->values(),
        ]);
    }
}
