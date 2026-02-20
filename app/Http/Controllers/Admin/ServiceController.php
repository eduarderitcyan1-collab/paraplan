<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $items = Service::ordered()->paginate(10);
        return view('admin.service.index', compact('items'));
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'img_file' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'price' => 'required|integer|min:0',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:1',
        ]);

        $data = $request->only(['title', 'desc', 'price', 'link', 'order']);

        if ($request->hasFile('img_file')) {
            $data['img'] = $request->file('img_file')->store('service', 'public');
        }

        Service::create($data);

        return redirect()->route('service.index')
            ->with('success', 'Услуга успешно создана');
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'img_file' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'price' => 'required|integer|min:0',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:1',
        ]);

        $data = $request->only(['title', 'desc', 'price', 'link', 'order']);

        if ($request->hasFile('img_file')) {

            if ($service->img && Storage::disk('public')->exists($service->img)) {
                Storage::disk('public')->delete($service->img);
            }

            $data['img'] = $request->file('img_file')->store('service', 'public');
        }

        $service->update($data);

        return redirect()->route('service.index')
            ->with('success', 'Услуга обновлена');
    }

    public function destroy(Service $service)
    {
        if ($service->img && Storage::disk('public')->exists($service->img)) {
            Storage::disk('public')->delete($service->img);
        }

        $service->delete();

        return redirect()->route('service.index')
            ->with('success', 'Услуга удалена');
    }
}
