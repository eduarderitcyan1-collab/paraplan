<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Показать список всех предложений
     */
    public function index()
    {
        $offers = Offer::ordered()->get();
        return view('admin.offer.index', compact('offers'));
    }

    /**
     * Показать форму создания нового предложения
     */
    public function create()
    {
        return view('admin.offer.create');
    }

    /**
     * Сохранить новое предложение
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'img' => 'required|image|max:2048',
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'order' => 'nullable|integer',
        ], [
            'img.required' => 'Поле "Изображение" обязательно.',
            'img.image' => 'Файл должен быть изображением.',
            'title.required' => 'Поле "Заголовок" обязательно.',
        ]);

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('offers', 'public');
            $validated['img'] = $path;
        }

        Offer::create($validated);

        return redirect()->route('offer.index')->with('success', 'Предложение успешно создано.');
    }

    /**
     * Показать форму редактирования предложения
     */
    public function edit(Offer $offer)
    {
        return view('admin.offer.edit', compact('offer'));
    }

    /**
     * Обновить предложение
     */
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'img' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'order' => 'nullable|integer',
        ], [
            'img.image' => 'Файл должен быть изображением.',
            'title.required' => 'Поле "Заголовок" обязательно.',
        ]);

        if ($request->hasFile('img')) {
            // Удаляем старое изображение
            if ($offer->img && \Storage::disk('public')->exists($offer->img)) {
                \Storage::disk('public')->delete($offer->img);
            }
            $path = $request->file('img')->store('offers', 'public');
            $validated['img'] = $path;
        }

        $offer->update($validated);

        return redirect()->route('admin.offer.index')->with('success', 'Предложение успешно обновлено.');
    }

    /**
     * Удалить предложение
     */
    public function destroy(Offer $offer)
    {
        // Удаляем изображение
        if ($offer->img && \Storage::disk('public')->exists($offer->img)) {
            \Storage::disk('public')->delete($offer->img);
        }

        $offer->delete();

        return redirect()->route('offer.index')->with('success', 'Предложение успешно удалено.');
    }
}
