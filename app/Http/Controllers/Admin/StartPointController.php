<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StartPoint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StartPointController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $items = StartPoint::query()
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->string('q').'%'))
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(20);

        return response()->json($items);
    }

    public function store(Request $request): JsonResponse
    {
        $item = StartPoint::create($this->validated($request));

        return response()->json($item, 201);
    }

    public function show(StartPoint $startPoint): JsonResponse
    {
        return response()->json($startPoint);
    }

    public function update(Request $request, StartPoint $startPoint): JsonResponse
    {
        $startPoint->update($this->validated($request, $startPoint->id));

        return response()->json($startPoint);
    }

    public function destroy(StartPoint $startPoint): JsonResponse
    {
        $startPoint->delete();

        return response()->noContent();
    }

    private function validated(Request $request, ?int $itemId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:start_points,slug'.($itemId ? ','.$itemId : '')],
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
