<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAboutRequest;

class AboutController extends Controller
{
    public function edit()
    {
        // Получаем первую запись или создаем пустую
        $about = About::first() ?? new About();

        return view('admin.about.edit', compact('about'));
    }

    public function update(UpdateAboutRequest $request)
    {
        $data = $request->validated();

        $about = About::first() ?? new About();

        if ($request->hasFile('video')) {

            if ($about->video && Storage::disk('public')->exists($about->video)) {
                Storage::disk('public')->delete($about->video);
            }

            $data['video'] = $request->file('video')->store('about', 'public');
        } else {
            unset($data['video']);
        }

        $about->fill($data);
        $about->save();

        return redirect()
            ->route('about.edit')
            ->with('success', 'Раздел "О нас" обновлен');
    }
}
