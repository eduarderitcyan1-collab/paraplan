<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $items = Route::orderBy('order')->paginate(10);
        return view('admin.route.index', compact('items'));
    }

    public function create()
    {
        return view('admin.route.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'main'  => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $isMain = $request->has('main');

        // Если этот маршрут будет главным, снимаем main с других
        if ($isMain) {
            Route::where('main', true)->update(['main' => false]);
        }

        $data['main'] = $isMain;

        Route::create($data);

        return redirect()->route('route.index')->with('success', 'Маршрут успешно создан.');
    }

    public function edit(Route $route)
    {
        return view('admin.route.edit', compact('route'));
    }

    public function update(Request $request, Route $route)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'main'  => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $isMain = $request->has('main');

        // Если обновляем запись и ставим ее главной
        if ($isMain) {
            Route::where('main', true)->where('id', '!=', $route->id)->update(['main' => false]);
        }

        $data['main'] = $isMain;

        $route->update($data);

        return redirect()->route('route.index')->with('success', 'Маршрут успешно обновлен.');
    }

    public function destroy(Route $route)
    {
        $route->delete();

        return redirect()->route('route.index')->with('success', 'Маршрут успешно удален.');
    }
}