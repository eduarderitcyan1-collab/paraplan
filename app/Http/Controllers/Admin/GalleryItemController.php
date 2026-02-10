<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryItemStoreRequest;
use App\Http\Requests\Admin\GalleryItemUpdateRequest;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        $items = GalleryItem::query()->orderBy('display_order')->paginate(30);

        return view('admin.gallery-items.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.gallery-items.create');
    }

    public function store(GalleryItemStoreRequest $request): RedirectResponse
    {
        GalleryItem::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.gallery-items.index')->with('status', 'Элемент галереи создан.');
    }

    public function edit(GalleryItem $galleryItem): View
    {
        return view('admin.gallery-items.edit', compact('galleryItem'));
    }

    public function update(GalleryItemUpdateRequest $request, GalleryItem $galleryItem): RedirectResponse
    {
        $galleryItem->update([
            ...$request->validated(),
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.gallery-items.index')->with('status', 'Элемент галереи обновлен.');
    }

    public function destroy(GalleryItem $galleryItem): RedirectResponse
    {
        $galleryItem->delete();

        return redirect()->route('admin.gallery-items.index')->with('status', 'Элемент галереи удален.');
    }
}
