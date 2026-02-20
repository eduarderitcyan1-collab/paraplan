<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $items = Review::ordered()->paginate(10);

        return view('admin.review.index', compact('items'));
    }

    public function create()
    {
        return view('admin.review.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'published_at' => 'nullable|date',
            'order' => 'nullable|integer',
            'photos.*' => 'nullable|image|max:2048',
        ]);

        $review = Review::create($request->only([
            'title',
            'desc',
            'published_at',
            'order'
        ]));

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('reviews', 'public');

                ReviewPhoto::create([
                    'review_id' => $review->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('review.index')
            ->with('success', 'Отзыв успешно создан');
    }

    public function edit(Review $review)
    {
        $review->load('photos');
        return view('admin.review.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'published_at' => 'nullable|date',
            'order' => 'nullable|integer',
            'photos.*' => 'nullable|image|max:2048',
            'delete_photos.*' => 'nullable|integer',
        ]);

        // обновляем данные отзыва
        $review->update($request->only(['title', 'desc', 'published_at', 'order']));

        // удаляем отмеченные фото
        if ($request->filled('delete_photos')) {
            $photos = $review->photos()->whereIn('id', $request->delete_photos)->get();

            foreach ($photos as $photo) {
                Storage::disk('public')->delete($photo->path);
                $photo->delete();
            }
        }

        // добавляем новые фото
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('reviews', 'public');

                ReviewPhoto::create([
                    'review_id' => $review->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('review.edit', $review)
                        ->with('success', 'Отзыв успешно обновлён');
    }

    public function destroy(Review $review)
    {
        foreach ($review->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
        }

        $review->delete();

        return redirect()->route('review.index')
            ->with('success', 'Отзыв удалён');
    }
}
