<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SertificateController extends Controller
{
    public function index()
    {
        $items = Sertificate::ordered()->paginate(10);
        return view('admin.sertificate.index', compact('items'));
    }

    public function create()
    {
        return view('admin.sertificate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'img_file' => 'required|file|image|mimes:png,jpg,jpeg,svg',
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('img_file')) {
            $data['img'] = $request->file('img_file')->store('sertificate', 'public');
        }

        Sertificate::create($data);

        return redirect()->route('sertificate.index')
            ->with('success', 'Сертификат успешно создан');
    }

    public function edit(Sertificate $sertificate)
    {
        return view('admin.sertificate.edit', compact('sertificate'));
    }

    public function update(Request $request, Sertificate $sertificate)
    {
        $request->validate([
            'img_file' => 'nullable|file|image|mimes:png,jpg,jpeg,svg',
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('img_file')) {
            // Удаляем старое изображение
            if ($sertificate->img) {
                Storage::disk('public')->delete($sertificate->img);
            }
            $data['img'] = $request->file('img_file')->store('sertificate', 'public');
        }

        $sertificate->update($data);

        return redirect()->route('sertificate.index')
            ->with('success', 'Сертификат обновлен');
    }

    public function destroy(Sertificate $sertificate)
    {
        if ($sertificate->img) {
            Storage::disk('public')->delete($sertificate->img);
        }
        $sertificate->delete();

        return redirect()->route('sertificate.index')
            ->with('success', 'Сертификат удален');
    }
}
