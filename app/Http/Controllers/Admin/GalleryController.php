<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $request->validate([
            'file' => ['required', 'array'],
            'file.*' => ['file', function ($attribute, $value, $fail) {
                if (! $value->isValid()) {
                    $fail('Файл не загружен.');

                    return;
                }

                $mime = $value->getClientMimeType();
                $extension = strtolower($value->getClientOriginalExtension());
                $size = $value->getSize();

                $isPhoto = $mime === 'image/webp' || $extension === 'webp';
                $isVideo = $mime === 'video/webm' || $extension === 'webm';

                if (! $isPhoto && ! $isVideo) {
                    $fail('Допустимы только WebP (изображения) и WebM (видео).');

                    return;
                }

                if ($isPhoto && $size > 2 * 1024 * 1024) {
                    $fail('Изображение не должно превышать 2 МБ.');
                }

                if ($isVideo && $size > 7 * 1024 * 1024) {
                    $fail('Видео не должно превышать 7 МБ.');
                }
            }],
            'order' => 'nullable|integer',
        ]);

        $files = Arr::wrap($request->file('file'));
        $baseOrder = $request->input('order');

        foreach ($files as $index => $file) {
            $path = $file->store('gallery', 'public');
            $type = in_array(strtolower($file->getClientOriginalExtension()), ['webp'])
                ? 'photo'
                : 'video';

            $data = [
                'path' => $path,
                'type' => $type,
            ];

            if (! is_null($baseOrder)) {
                $data['order'] = $baseOrder + $index;
            }

            Gallery::create($data);
        }

        return redirect()->route('gallery.index')
            ->with('success', 'Запись добавлена');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'file' => ['nullable', 'file', function ($attribute, $value, $fail) {
                if (! $value->isValid()) {
                    $fail('Файл не загружен.');

                    return;
                }

                $mime = $value->getClientMimeType();
                $extension = strtolower($value->getClientOriginalExtension());
                $size = $value->getSize();

                $isPhoto = $mime === 'image/webp' || $extension === 'webp';
                $isVideo = $mime === 'video/webm' || $extension === 'webm';

                if (! $isPhoto && ! $isVideo) {
                    $fail('Допустимы только WebP (изображения) и WebM (видео).');

                    return;
                }

                if ($isPhoto && $size > 2 * 1024 * 1024) {
                    $fail('Изображение не должно превышать 2 МБ.');
                }

                if ($isVideo && $size > 7 * 1024 * 1024) {
                    $fail('Видео не должно превышать 7 МБ.');
                }
            }],
            'order' => 'nullable|integer',
        ]);

        $data = [];

        if ($request->filled('order')) {
            $data['order'] = $request->input('order');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('gallery', 'public');
            $type = in_array(strtolower($file->getClientOriginalExtension()), ['webp'])
                ? 'photo'
                : 'video';

            // Удаляем старый файл, если он есть
            if ($gallery->path) {
                $this->deleteStoredFile($gallery->path);
            }

            $data['path'] = $path;
            $data['type'] = $type;
        }

        if (! empty($data)) {
            $gallery->update($data);
        }

        return redirect()->route('gallery.index')
            ->with('success', 'Запись обновлена');
    }

    protected function deleteStoredFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        $disk = Storage::disk('public');

        if ($disk->exists($path)) {
            $disk->delete($path);

            return;
        }

        $normalized = Str::after($path, 'storage/');
        if ($normalized && $disk->exists($normalized)) {
            $disk->delete($normalized);
        }
    }

    public function destroy(Gallery $gallery)
    {
        $this->deleteStoredFile($gallery->path);
        $gallery->delete();

        return redirect()->route('gallery.index')
            ->with('success', 'Удалено');
    }
}
