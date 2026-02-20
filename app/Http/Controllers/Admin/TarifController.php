<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TarifController extends Controller
{
    public function index()
    {
        $items = Tarif::orderBy('id', 'asc')->paginate(10);
        return view('admin.tarif.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tarif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'img_file' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'title' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'price' => 'required|string|max:255',
        ]);

        $data = $request->only(['title', 'time', 'price', 'order']);

        if ($request->hasFile('img_file')) {
            if (!empty($tarif->img ?? false) && Storage::disk('public')->exists($tarif->img)) {
                Storage::disk('public')->delete($tarif->img);
            }
            $data['img'] = $request->file('img_file')->store('tarif', 'public');
        }

        Tarif::create($data);

        return redirect()->route('tarif.index')->with('success', 'Тариф успешно создан');
    }

    public function edit(Tarif $tarif)
    {
        return view('admin.tarif.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'img_file' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'title' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'price' => 'required|string|max:255',
        ]);

        $data = $request->only(['title', 'time', 'price', 'order']);

        if ($request->hasFile('img_file')) {
            if (!empty($tarif->img ?? false) && Storage::disk('public')->exists($tarif->img)) {
                Storage::disk('public')->delete($tarif->img);
            }
            $data['img'] = $request->file('img_file')->store('tarif', 'public');
        }

        $tarif->update($data);

        return redirect()->route('tarif.index')->with('success', 'Тариф обновлён');
    }

    public function destroy(Tarif $tarif)
    {
        if ($tarif->img && Storage::disk('public')->exists($tarif->img)) {
            Storage::disk('public')->delete($tarif->img);
        }

        $tarif->delete();

        return redirect()->route('tarif.index')->with('success', 'Тариф удалён');
    }
}
