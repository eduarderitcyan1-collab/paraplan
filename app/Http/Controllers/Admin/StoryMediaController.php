<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\StoryMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryMediaController extends Controller
{
    public function index(Story $story)
    {
        $items = $story->media()->orderBy('sort')->orderBy('id')->paginate(12);

        return view('admin.story_media.index', compact('story', 'items'));
    }

    public function create(Story $story)
    {
        return view('admin.story_media.create', compact('story'));
    }

    public function store(Request $request, Story $story)
    {
        $data = $request->validate([
            'file' => ['required', 'array'],
            'file.*' => ['file', function ($attribute, $value, $fail) {
                $mime = $value->getClientMimeType();
                $size = $value->getSize();

                if ($mime === 'image/webp') {
                    if ($size > 2 * 1024 * 1024) {
                        $fail('WebP не должен превышать 2 МБ.');
                    }
                } elseif ($mime === 'video/webm') {
                    if ($size > 8 * 1024 * 1024) {
                        $fail('WebM не должен превышать 8 МБ.');
                    }
                } else {
                    $fail('Допустимы только WebP (изображения) и WebM (видео).');
                }
            }],
            'sort' => ['nullable', 'integer', 'min:0'],
        ]);

        $maxSort = $story->media()->max('sort');
        $baseSort = $data['sort'] ?? ($maxSort === null ? 0 : $maxSort + 1);

        foreach ($request->file('file') as $index => $file) {
            $mime = $file->getClientMimeType();
            $type = $mime === 'image/webp' ? 'photo' : 'video';
            $path = $file->store('stories/media', 'public');

            $story->media()->create([
                'type' => $type,
                'path' => $path,
                'sort' => $baseSort + $index,
            ]);
        }

        return redirect()->route('stories.media.index', $story)
            ->with('success', 'Медиа добавлено.');
    }

    public function show(Story $story, StoryMedia $medium)
    {
        abort_unless($medium->story_id === $story->id, 404);

        return redirect()->route('stories.media.edit', [$story, $medium]);
    }

    public function edit(Story $story, StoryMedia $medium)
    {
        abort_unless($medium->story_id === $story->id, 404);

        return view('admin.story_media.edit', compact('story', 'medium'));
    }

    public function update(Request $request, Story $story, StoryMedia $medium)
    {
        abort_unless($medium->story_id === $story->id, 404);

        $data = $request->validate([
            'file' => ['nullable', 'file', function ($attribute, $value, $fail) {
                if (! $value) {
                    return;
                }

                $mime = $value->getClientMimeType();
                $size = $value->getSize();

                if ($mime === 'image/webp') {
                    if ($size > 2 * 1024 * 1024) {
                        $fail('WebP не должен превышать 2 МБ.');
                    }
                } elseif ($mime === 'video/webm') {
                    if ($size > 8 * 1024 * 1024) {
                        $fail('WebM не должен превышать 8 МБ.');
                    }
                } else {
                    $fail('Допустимы только WebP (изображения) и WebM (видео).');
                }
            }],
            'sort' => ['nullable', 'integer', 'min:0'],
        ]);

        $updateData = [
            'sort' => $data['sort'] ?? $medium->sort,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mime = $file->getClientMimeType();
            $type = $mime === 'image/webp' ? 'photo' : 'video';

            Storage::disk('public')->delete($medium->path);
            $updateData['path'] = $file->store('stories/media', 'public');
            $updateData['type'] = $type;
        }

        $medium->update($updateData);

        return redirect()->route('stories.media.index', $story)
            ->with('success', 'Медиа обновлено.');
    }

    public function destroy(Story $story, StoryMedia $medium)
    {
        abort_unless($medium->story_id === $story->id, 404);

        Storage::disk('public')->delete($medium->path);
        $medium->delete();

        return redirect()->route('stories.media.index', $story)
            ->with('success', 'Медиа удалено.');
    }
}
