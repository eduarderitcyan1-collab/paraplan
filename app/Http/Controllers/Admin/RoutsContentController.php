<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\RoutsContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoutsContentController extends Controller
{
    public function index()
    {
        $items = RoutsContent::with('route')->orderBy('order')->paginate(10);
        return view('admin.routs_content.index', compact('items'));
    }

    public function create()
    {
        $routes = Route::orderBy('order')->get();
        return view('admin.routs_content.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'routs_id'        => 'required|exists:routes,id',
            'title'           => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:routs_content,slug',
            'desc'            => 'nullable|string',
            'photo'           => 'nullable|image|mimes:webp|max:2048',
            'gallery.*'       => 'nullable|image|mimes:webp|max:2048',
            'characteristics' => 'nullable|array',
            'advantages'      => 'nullable|array',
            'order'           => 'nullable|integer',
        ]);

        // Главное фото
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('routs_content', 'public');
        }

        // Объединяем характеристики
        $characteristics = [];
        if (!empty($data['characteristics'])) {
            for ($i = 0; $i < count($data['characteristics']); $i += 2) {
                $property = $data['characteristics'][$i]['property'] ?? null;
                $value = $data['characteristics'][$i + 1]['value'] ?? null;
                if ($property || $value) {
                    $characteristics[] = [
                        'property' => $property,
                        'value' => $value,
                    ];
                }
            }
        }

        // Объединяем преимущества
        $advantages = [];
        if (!empty($data['advantages'])) {
            for ($i = 0; $i < count($data['advantages']); $i += 2) {
                $title = $data['advantages'][$i]['title'] ?? null;
                $description = $data['advantages'][$i + 1]['description'] ?? null;
                if ($title || $description) {
                    $advantages[] = [
                        'title' => $title,
                        'description' => $description,
                    ];
                }
            }
        }

        $data['characteristics'] = $characteristics;
        $data['advantages'] = $advantages;
        
        // Сначала создаем модель
        $content = RoutsContent::create($data);


        // Потом добавляем галерею
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $content->gallery()->create([
                    'path'  => $file->store('routs_content/gallery', 'public'),
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('routsContent.index')
            ->with('success', 'Контент маршрута создан.');
    }

    public function edit(RoutsContent $routsContent)
    {
        $routes = Route::orderBy('order')->get();
        return view('admin.routs_content.edit', compact('routsContent', 'routes'));
    }

    public function update(Request $request, RoutsContent $routsContent)
    {
        $data = $request->validate([
            'routs_id'        => 'required|exists:routes,id',
            'title'           => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:routs_content,slug,' . $routsContent->id,
            'desc'            => 'nullable|string',
            'photo'           => 'nullable|image|mimes:webp|max:2048',
            'gallery.*'       => 'nullable|image|mimes:webp|max:2048',
            'characteristics' => 'nullable|array',
            'advantages'      => 'nullable|array',
            'order'           => 'nullable|integer',
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        // Обновление главного фото
        if ($request->hasFile('photo')) {
            if ($routsContent->photo) {
                Storage::disk('public')->delete($routsContent->photo);
            }

            $data['photo'] = $request->file('photo')->store('routs_content', 'public');
        }

        $data['characteristics'] = $data['characteristics'] ?? [];
        $data['advantages'] = $data['advantages'] ?? [];

        $routsContent->update($data);

        // Добавление новых фото в галерею
        if ($request->hasFile('gallery')) {
            $lastOrder = $routsContent->gallery()->max('order') ?? 0;

            foreach ($request->file('gallery') as $index => $file) {
                $routsContent->gallery()->create([
                    'path'  => $file->store('routs_content/gallery', 'public'),
                    'order' => $lastOrder + $index + 1,
                ]);
            }
        }

        // Обновление порядка галереи
        if ($request->filled('gallery_order')) {

            foreach ($request->gallery_order as $index => $id) {
                \App\Models\RoutsContentGallery::where('id', $id)
                    ->update(['order' => $index + 1]);
            }
        }

        // Удаление отмеченных фото
        if ($request->filled('delete_gallery')) {

            $images = \App\Models\RoutsContentGallery::whereIn(
                'id',
                $request->delete_gallery
            )->get();

            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        return redirect()->route('routsContent.index')
            ->with('success', 'Контент маршрута обновлен.');
    }

    public function destroy(RoutsContent $routsContent)
    {
        // Удаляем главное фото
        if ($routsContent->photo) {
            Storage::disk('public')->delete($routsContent->photo);
        }

        // Удаляем фотографии галереи
        foreach ($routsContent->gallery as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        // Удаляем сам контент
        $routsContent->delete();

        return redirect()->route('routsContent.index')
            ->with('success', 'Контент маршрута удален.');
    }
}