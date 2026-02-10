<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlyPoint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlyPointController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $items = FlyPoint::query()
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->string('q').'%'))
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(20);

        return response()->json($items);
    }

    public function store(Request $request): JsonResponse
    {
        $item = FlyPoint::create($this->validated($request));

        return response()->json($item, 201);
    }

    public function show(FlyPoint $flyPoint): JsonResponse
    {
        return response()->json($flyPoint);
    }

    public function update(Request $request, FlyPoint $flyPoint): JsonResponse
    {
        $flyPoint->update($this->validated($request, $flyPoint->id));

        return response()->json($flyPoint);
    }

    public function destroy(FlyPoint $flyPoint): JsonResponse
    {
        $flyPoint->delete();

        return response()->noContent();
    }

    private function validated(Request $request, ?int $itemId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:fly_points,slug'.($itemId ? ','.$itemId : '')],
            'summary' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
            'meta' => ['nullable', 'array'],
        ]);
    }
}
