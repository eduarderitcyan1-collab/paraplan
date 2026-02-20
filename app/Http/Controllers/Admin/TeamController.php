<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::ordered()->paginate(10); // 10 записей на страницу
        return view('admin.team.index', compact('teams'));
        return view('admin.team.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'img' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('team', 'public');
        }

        Team::create($data);

        return redirect()->route('team.index')->with('success', 'Участник создан');
    }

    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'img' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('team', 'public');
        }

        $team->update($data);

        return redirect()->route('team.index')->with('success', 'Участник обновлен');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('team.index')->with('success', 'Удалено');
    }
}
