<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParaplanRoute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $items = ParaplanRoute::query()
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->string('q').'%'))
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(20);

        return response()->json($items);
    }

    public function store(Request $request): JsonResponse
    {
        $item = ParaplanRoute::create($this->validated($request));

        return response()->json($item, 201);
    }

    public function show(ParaplanRoute $paraplanRoute): JsonResponse
    {
        return response()->json($paraplanRoute);
    }

    public function update(Request $request, ParaplanRoute $paraplanRoute): JsonResponse
    {
        $paraplanRoute->update($this->validated($request, $paraplanRoute->id));

        return response()->json($paraplanRoute);
    }

    public function destroy(ParaplanRoute $paraplanRoute): JsonResponse
    {
        $paraplanRoute->delete();

        return response()->noContent();
    }

    private function validated(Request $request, ?int $itemId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:paraplan_routes,slug'.($itemId ? ','.$itemId : '')],
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
