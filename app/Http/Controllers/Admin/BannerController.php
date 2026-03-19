<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function edit()
    {
        $banner = Banner::first();

        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm',
            'type' => 'required|in:image,video',
        ]);

        $banner = Banner::first();

        if (! $banner) {
            $banner = new Banner;
        }

        if ($request->hasFile('media')) {
            // удалить старый файл
            if ($banner->media_path) {
                Storage::disk('public')->delete($banner->media_path);
            }

            $path = $request->file('media')->store('banner', 'public');
            $banner->media_path = $path;
        }

        $banner->title = $request->title;
        $banner->type = $request->type;

        $banner->save();

        return redirect()->back()->with('success', 'Баннер обновлён');
    }
}
