<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlyPoint;
use Illuminate\Http\Request;

class FlyPointController extends Controller
{
    public function index()
    {
        $items = FlyPoint::orderBy('order')->paginate(10);
        return view('admin.flyPoint.index', compact('items'));
    }

    public function create()
    {
        return view('admin.flyPoint.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'img' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('fly_points', 'public');
        }

        FlyPoint::create($data);

        return redirect()->route('flyPoint.index')->with('success', 'Запись успешно создана');
    }

    public function edit(FlyPoint $flyPoint)
    {
        return view('admin.flyPoint.edit', compact('flyPoint'));
    }

    public function update(Request $request, FlyPoint $flyPoint)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'string',
            'img' => 'image|max:2048',
            'link' => 'url|max:255',
            'order' => 'integer',
        ]);

        if ($request->hasFile('img')) {
            // удалить старое изображение
            if ($flyPoint->img) {
                \Storage::disk('public')->delete($flyPoint->img);
            }
            $data['img'] = $request->file('img')->store('fly_points', 'public');
        }

        $flyPoint->update($data);

        return redirect()->route('flyPoint.index')->with('success', 'Запись успешно обновлена');
    }

    public function destroy(FlyPoint $flyPoint)
    {
        if ($flyPoint->img) {
            \Storage::disk('public')->delete($flyPoint->img);
        }

        $flyPoint->delete();

        return redirect()->route('flyPoint.index')->with('success', 'Запись успешно удалена');
    }
}
