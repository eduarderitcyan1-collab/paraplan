<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $items = Article::ordered()->paginate(10);
        return view('admin.article.index', compact('items'));
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:webp|max:2048',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'desc'  => 'required|string',
            'gallery.*' => 'nullable|image|mimes:webp|max:2048',
            'order' => 'nullable|integer',
        ]);

        // Главное фото
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('articles', 'public');
        }

        $article = Article::create($data);

        // Потом добавляем галерею
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $article->gallery()->create([
                    'path'  => $file->store('articles/gallery', 'public'),
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('articles.index')->with('success', 'Статья создана');
    }

    public function edit(Article $article)
    {
        $article->load('gallery');
        return view('admin.article.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|max:2048',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $article->id,
            'desc'  => 'required|string',
            'gallery.*' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        // Обновление главного фото
        if ($request->hasFile('img')) {
            if ($article->img) {
                Storage::disk('public')->delete($article->img);
            }

            $data['img'] = $request->file('img')->store('articles', 'public');
        }

        $article->update($data);

        // Добавление новых фото в галерею
        if ($request->hasFile('gallery')) {
            $lastOrder = $article->gallery()->max('order') ?? 0;

            foreach ($request->file('gallery') as $index => $file) {
                $article->gallery()->create([
                    'path'  => $file->store('articles/gallery', 'public'),
                    'order' => $lastOrder + $index + 1,
                ]);
            }
        }

        // Обновление порядка галереи
        if ($request->filled('gallery_order')) {

            foreach ($request->gallery_order as $index => $id) {
                \App\Models\ArticleGallery::where('id', $id)
                    ->update(['order' => $index + 1]);
            }
        }

        // Удаление отмеченных фото
        if ($request->filled('delete_gallery')) {

            $images = \App\Models\ArticleGallery::whereIn(
                'id',
                $request->delete_gallery
            )->get();

            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        return redirect()->route('articles.index')->with('success', 'Статья обновлена');
    }

    public function destroy(Article $article)
    {
        // Удаляем главное фото
        if ($article->img) {
            Storage::disk('public')->delete($article->img);
        }

        // Удаляем фотографии галереи
        foreach ($article->gallery as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена');
    }
}