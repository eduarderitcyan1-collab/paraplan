<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaStoreRequest;
use App\Http\Requests\Admin\MediaUpdateRequest;
use App\Models\Block;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        $media = Media::query()->with('block.page')->orderBy('display_order')->latest('id')->paginate(20);

        return view('admin.media.index', compact('media'));
    }

    public function create(): View
    {
        $blocks = Block::query()->with('page')->orderBy('id')->get();

        return view('admin.media.create', compact('blocks'));
    }

    public function store(MediaStoreRequest $request): RedirectResponse
    {
        $blockId = $request->input('block_id');
        $maxOrder = Media::query()->where('block_id', $blockId)->max('display_order');

        Media::create([
            ...$request->validated(),
            'display_order' => $request->integer('display_order', (int) $maxOrder + 1),
            'uploaded_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.media.index')->with('status', 'Медиа добавлено.');
    }

    public function edit(Media $medium): View
    {
        $blocks = Block::query()->with('page')->orderBy('id')->get();

        return view('admin.media.edit', ['mediaItem' => $medium, 'blocks' => $blocks]);
    }

    public function update(MediaUpdateRequest $request, Media $medium): RedirectResponse
    {
        $medium->update([
            ...$request->validated(),
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.media.index')->with('status', 'Медиа обновлено.');
    }

    public function destroy(Media $medium): RedirectResponse
    {
        $medium->delete();

        return redirect()->route('admin.media.index')->with('status', 'Медиа удалено.');
    }
}
