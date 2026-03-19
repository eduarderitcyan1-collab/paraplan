<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::orderBy('order')->paginate(10);

        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'path' => 'required|string',
            'order' => 'nullable|integer',
            'type' => 'required|in:photo,video',
        ]);

        Gallery::create($data);

        return redirect()->route('gallery.index')
            ->with('success', 'Запись добавлена');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'path' => 'required|string',
            'order' => 'nullable|integer',
            'type' => 'required|in:photo,video',
        ]);

        $gallery->update($data);

        return redirect()->route('gallery.index')
            ->with('success', 'Запись обновлена');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Удалено');
    }
}