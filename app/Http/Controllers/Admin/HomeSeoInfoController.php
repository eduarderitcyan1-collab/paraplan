<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSeoInfo;
use App\Support\EditorHtmlImageManager;
use Illuminate\Http\Request;

class HomeSeoInfoController extends Controller
{
    public function create()
    {
        if (HomeSeoInfo::query()->exists()) {
            return redirect()->route('seo-pages.index')->with('success', 'SEO-инфо для главной уже создано.');
        }

        return view('admin.seo.home-info-create');
    }

    public function store(Request $request)
    {
        if (HomeSeoInfo::query()->exists()) {
            return redirect()->route('seo-pages.index')->with('success', 'SEO-инфо для главной уже существует.');
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
        ]);

        HomeSeoInfo::query()->create($data);

        return redirect()->route('seo-pages.index')->with('success', 'SEO-инфо на главной создано.');
    }

    public function edit(HomeSeoInfo $homeSeoInfo)
    {
        return view('admin.seo.home-info-edit', compact('homeSeoInfo'));
    }

    public function update(Request $request, HomeSeoInfo $homeSeoInfo)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
        ]);

        EditorHtmlImageManager::deleteRemovedImages($homeSeoInfo->desc, $data['desc']);

        $homeSeoInfo->update($data);

        return redirect()->route('seo-pages.index')->with('success', 'SEO-инфо на главной обновлено.');
    }
}
