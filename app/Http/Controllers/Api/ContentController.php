<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\GalleryItem;
use Illuminate\Http\JsonResponse;

class ContentController extends Controller
{
    public function index(): JsonResponse
    {
        $blocks = Block::query()->where('is_active', true)->with('items')->orderBy('display_order')->get();
        $gallery = GalleryItem::query()->orderBy('display_order')->get();

        return response()->json([
            'blocks' => $blocks->map(fn (Block $block) => [
                'name' => $block->name,
                'code' => $block->code,
                'items' => $block->items->map(fn ($item) => [
                    'title' => $item->title,
                    'subtitle' => $item->subtitle,
                    'description' => $item->description,
                    'payload' => $item->payload,
                ])->values(),
            ])->values(),
            'gallery' => [
                'photo' => $gallery->where('type', 'photo')->values(),
                'video' => $gallery->where('type', 'video')->values(),
            ],
        ]);
    }

    public function show(string $code): JsonResponse
    {
        $block = Block::query()->where('is_active', true)->where('code', $code)->with('items')->firstOrFail();

        return response()->json([
            'name' => $block->name,
            'code' => $block->code,
            'items' => $block->items->map(fn ($item) => [
                'title' => $item->title,
                'subtitle' => $item->subtitle,
                'description' => $item->description,
                'payload' => $item->payload,
            ])->values(),
        ]);
    }
}
