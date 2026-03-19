<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function index()
    {
        $items = Story::withCount('media')->latest()->paginate(10);

        return view('admin.story.index', compact('items'));
    }

    public function create()
    {
        return view('admin.story.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'preview' => ['nullable', 'file', 'mimetypes:image/webp', 'mimes:webp', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'border_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        if ($request->hasFile('preview')) {
            $data['preview'] = $request->file('preview')->store('stories/preview', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        Story::create($data);

        return redirect()->route('stories.index')
            ->with('success', 'История создана.');
    }

    public function edit(Story $story)
    {
        return view('admin.story.edit', compact('story'));
    }

    public function show(Story $story)
    {
        return redirect()->route('stories.edit', $story);
    }

    public function update(Request $request, Story $story)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'preview' => ['nullable', 'file', 'mimetypes:image/webp', 'mimes:webp', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'border_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        if ($request->hasFile('preview')) {
            if ($story->preview) {
                Storage::disk('public')->delete($story->preview);
            }

            $data['preview'] = $request->file('preview')->store('stories/preview', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $story->update($data);

        return redirect()->route('stories.index')
            ->with('success', 'История обновлена.');
    }

    public function destroy(Story $story)
    {
        if ($story->preview) {
            Storage::disk('public')->delete($story->preview);
        }

        foreach ($story->media as $media) {
            Storage::disk('public')->delete($media->path);
        }

        $story->delete();

        return redirect()->route('stories.index')
            ->with('success', 'История удалена.');
    }
}
