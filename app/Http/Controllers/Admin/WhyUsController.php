<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyUsController extends Controller
{
    public function index()
    {
        $items = WhyUs::ordered()->paginate(10);
        return view('admin.whyUs.index', compact('items'));
    }

    public function create()
    {
        return view('admin.whyUs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'svg_file' => 'required|file|mimes:svg',
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'order' => 'nullable|integer'
        ]);

        $data = $request->only(['title', 'desc', 'order']);

        // Сохраняем SVG на сервер
        if ($request->hasFile('svg_file')) {
            $file = $request->file('svg_file');
            $path = $file->store('whyus', 'public'); // storage/app/public/whyus
            $data['svg'] = $path;
        }

        WhyUs::create($data);

        return redirect()->route('whyUs.index')
            ->with('success', 'Запись успешно создана');
    }

    public function edit(WhyUs $whyUs)
    {
        return view('admin.whyUs.edit', compact('whyUs'));
    }

    public function update(Request $request, WhyUs $whyUs)
    {
        $request->validate([
            'svg_file' => 'nullable|file|mimes:svg',
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'order' => 'nullable|integer'
        ]);

        $data = $request->only(['title', 'desc', 'order']);

        // Если загружен новый SVG — удаляем старый и сохраняем новый
        if ($request->hasFile('svg_file')) {
            if ($whyUs->svg && Storage::disk('public')->exists($whyUs->svg)) {
                Storage::disk('public')->delete($whyUs->svg);
            }

            $file = $request->file('svg_file');
            $path = $file->store('whyus', 'public');
            $data['svg'] = $path;
        }

        $whyUs->update($data);

        return redirect()->route('whyUs.index')
            ->with('success', 'Запись обновлена');
    }

    public function destroy(WhyUs $whyUs)
    {
        // Удаляем файл SVG с сервера
        if ($whyUs->svg && Storage::disk('public')->exists($whyUs->svg)) {
            Storage::disk('public')->delete($whyUs->svg);
        }

        $whyUs->delete();

        return redirect()->route('whyUs.index')
            ->with('success', 'Запись удалена');
    }
}
