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

            // десктоп
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm',
            'type' => 'required|in:image,video',

            // мобильный
            'mobile_media_path' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm',
        ]);

        $banner = Banner::first();

        if (! $banner) {
            $banner = new Banner;
        }

        /**
         * ДЕСКТОП
         */
        if ($request->hasFile('media')) {
            if ($banner->media_path) {
                Storage::disk('public')->delete($banner->media_path);
            }

            $path = $request->file('media')->store('banner', 'public');
            $banner->media_path = $path;
        }

        $banner->type = $request->type;

        /**
         * МОБИЛКА
         */
        if ($request->hasFile('mobile_media_path')) {
            if ($banner->mobile_media_path) {
                Storage::disk('public')->delete($banner->mobile_media_path);
            }

            $mobilePath = $request->file('mobile_media_path')->store('banner', 'public');
            $banner->mobile_media_path = $mobilePath;
        }

        /**
         * ОБЩЕЕ
         */
        $banner->title = $request->title;

        $banner->save();

        return redirect()->back()->with('success', 'Баннер обновлён');
    }
}