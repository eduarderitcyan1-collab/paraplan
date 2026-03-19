<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Support\EditorHtmlImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        $items = Faq::query()->ordered()->get();

        return view('admin.faq.index', compact('items'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
            'order' => ['nullable', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($data): void {
            $total = Faq::query()->count();
            $newOrder = $data['order'] ?? ($total + 1);
            $newOrder = max(1, min($newOrder, $total + 1));

            Faq::query()->where('order', '>=', $newOrder)->increment('order');

            Faq::query()->create([
                'title' => $data['title'],
                'desc' => $data['desc'],
                'order' => $newOrder,
            ]);
        });

        return redirect()->route('faq.index')->with('success', 'Вопрос-ответ добавлен.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
            'order' => ['nullable', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($faq, $data): void {
            $count = Faq::query()->count();
            $targetOrder = $data['order'] ?? $faq->order;
            $targetOrder = max(1, min($targetOrder, $count));

            if ($targetOrder > $faq->order) {
                Faq::query()
                    ->where('id', '!=', $faq->id)
                    ->whereBetween('order', [$faq->order + 1, $targetOrder])
                    ->decrement('order');
            } elseif ($targetOrder < $faq->order) {
                Faq::query()
                    ->where('id', '!=', $faq->id)
                    ->whereBetween('order', [$targetOrder, $faq->order - 1])
                    ->increment('order');
            }

            EditorHtmlImageManager::deleteRemovedImages($faq->desc, $data['desc']);

            $faq->update([
                'title' => $data['title'],
                'desc' => $data['desc'],
                'order' => $targetOrder,
            ]);
        });

        return redirect()->route('faq.index')->with('success', 'Вопрос-ответ обновлен.');
    }

    public function destroy(Faq $faq)
    {
        DB::transaction(function () use ($faq): void {
            EditorHtmlImageManager::deleteAllImages($faq->desc);

            $deletedOrder = $faq->order;
            $faq->delete();

            Faq::query()->where('order', '>', $deletedOrder)->decrement('order');
        });

        return redirect()->route('faq.index')->with('success', 'Вопрос-ответ удален.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['required', 'integer', 'exists:faqs,id'],
        ]);

        $ids = array_values(array_unique($data['ids']));

        DB::transaction(function () use ($ids): void {
            foreach ($ids as $index => $id) {
                Faq::query()->whereKey($id)->update([
                    'order' => $index + 1,
                ]);
            }
        });

        return response()->json([
            'ok' => true,
        ]);
    }
}
