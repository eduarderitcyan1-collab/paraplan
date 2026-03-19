<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingMaterialController extends Controller
{
    public function index()
    {
        $items = TrainingMaterial::ordered()->paginate(20);

        return view('admin.training_material.index', compact('items'));
    }

    public function create()
    {
        return view('admin.training_material.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:100', 'alpha_dash', 'unique:training_materials,key'],
            'title' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'media_file' => ['nullable', 'file', function ($attribute, $value, $fail) {
                if (! $value) {
                    return;
                }

                $mime = $value->getClientMimeType();
                $size = $value->getSize();

                if ($mime === 'image/webp') {
                    if ($size > 2 * 1024 * 1024) {
                        $fail('WebP (изображение) не должен превышать 2 МБ.');
                    }
                } elseif ($mime === 'video/webm') {
                    if ($size > 7 * 1024 * 1024) {
                        $fail('WebM (видео) не должен превышать 7 МБ.');
                    }
                } else {
                    $fail('Допустимы только WebP (изображение) и WebM (видео).');
                }
            }],
            'media_alt' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:1'],
        ]);

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $mime = $file->getClientMimeType();

            $data['media_type'] = $mime === 'image/webp' ? 'image' : 'video';
            $data['media_path'] = $file->store('training/materials', 'public');
        }

        unset($data['media_file']);

        TrainingMaterial::create($data);

        return redirect()->route('training-materials.index')->with('success', 'Материал создан.');
    }

    public function show(TrainingMaterial $trainingMaterial)
    {
        return redirect()->route('training-materials.edit', $trainingMaterial);
    }

    public function edit(TrainingMaterial $trainingMaterial)
    {
        return view('admin.training_material.edit', compact('trainingMaterial'));
    }

    public function update(Request $request, TrainingMaterial $trainingMaterial)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:100', 'alpha_dash', 'unique:training_materials,key,' . $trainingMaterial->id],
            'title' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'media_file' => ['nullable', 'file', function ($attribute, $value, $fail) {
                if (! $value) {
                    return;
                }

                $mime = $value->getClientMimeType();
                $size = $value->getSize();

                if ($mime === 'image/webp') {
                    if ($size > 2 * 1024 * 1024) {
                        $fail('WebP (изображение) не должен превышать 2 МБ.');
                    }
                } elseif ($mime === 'video/webm') {
                    if ($size > 7 * 1024 * 1024) {
                        $fail('WebM (видео) не должен превышать 7 МБ.');
                    }
                } else {
                    $fail('Допустимы только WebP (изображение) и WebM (видео).');
                }
            }],
            'media_alt' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:1'],
            'remove_media' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_media') && $trainingMaterial->media_path) {
            Storage::disk('public')->delete($trainingMaterial->media_path);
            $data['media_path'] = null;
            $data['media_type'] = null;
        }

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $mime = $file->getClientMimeType();

            if ($trainingMaterial->media_path) {
                Storage::disk('public')->delete($trainingMaterial->media_path);
            }

            $data['media_type'] = $mime === 'image/webp' ? 'image' : 'video';
            $data['media_path'] = $file->store('training/materials', 'public');
        }

        unset($data['media_file']);

        $trainingMaterial->update($data);

        return redirect()->route('training-materials.index')->with('success', 'Материал обновлен.');
    }

    public function destroy(TrainingMaterial $trainingMaterial)
    {
        if ($trainingMaterial->media_path) {
            Storage::disk('public')->delete($trainingMaterial->media_path);
        }

        $trainingMaterial->delete();

        return redirect()->route('training-materials.index')->with('success', 'Материал удален.');
    }
}
