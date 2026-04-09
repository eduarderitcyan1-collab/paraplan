<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Road;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateRoadRequest; // Создаём отдельный FormRequest

class RoadController extends Controller
{
    public function edit()
    {
        // Получаем первую запись или создаем пустую
        $road = Road::first() ?? new Road();

        return view('admin.road.edit', compact('road'));
    }

    public function update(UpdateRoadRequest $request)
    {
        $data = $request->validated();

        $road = Road::first() ?? new Road();

        // Обработка загрузки видео
        if ($request->hasFile('video')) {

            if ($road->video && Storage::disk('public')->exists($road->video)) {
                Storage::disk('public')->delete($road->video);
            }

            $data['video'] = $request->file('video')->store('roads', 'public');
        } else {
            unset($data['video']);
        }

        $road->fill($data);
        $road->save();

        return redirect()
            ->route('road.edit')
            ->with('success', 'Дорога обновлена');
    }
}