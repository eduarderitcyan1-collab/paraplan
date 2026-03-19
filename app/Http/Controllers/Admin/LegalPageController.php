<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalPageController extends Controller
{
    public function index()
    {
        $pages = LegalPage::all();

        // Проверяем, какие ключи уже заняты
        $usedKeys = $pages->pluck('key')->toArray();
        $availableKeys = array_diff([
            LegalPage::KEY_PRIVACY,
            LegalPage::KEY_CONSENT,
        ], $usedKeys);

        return view('admin.legal_pages.index', compact('pages', 'availableKeys'));
    }

    public function create()
    {
        $page = new LegalPage;

        // Ключи, для которых ещё нет записей
        $usedKeys = LegalPage::pluck('key')->toArray();
        $availableKeys = array_diff([
            LegalPage::KEY_PRIVACY,
            LegalPage::KEY_CONSENT,
        ], $usedKeys);

        if (empty($availableKeys)) {
            return redirect()->route('legal-pages.index')
                ->with('error', 'Невозможно создать новую страницу: все ключи уже существуют.');
        }

        return view('admin.legal_pages.form', compact('page', 'availableKeys'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|in:'.implode(',', [LegalPage::KEY_PRIVACY, LegalPage::KEY_CONSENT])
                     .'|unique:legal_pages,key',
            'title' => 'required|string|max:255',
            'content' => 'required|string', // TinyMCE отправляет HTML, сохраняем как есть
        ]);

        // Создаём страницу
        LegalPage::create([
            'key' => $validated['key'],
            'title' => $validated['title'],
            'content' => $validated['content'], // сохраняем HTML из редактора
        ]);

        return redirect()->route('legal-pages.index')
            ->with('success', 'Страница успешно создана.');
    }

    public function edit(LegalPage $legalPage)
    {
        $page = $legalPage;

        // Для редактирования ключ менять нельзя, поэтому передаём пустой массив
        $availableKeys = [];

        return view('admin.legal_pages.form', compact('page', 'availableKeys'));
    }

    public function update(Request $request, LegalPage $legalPage)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $legalPage->update([
            'title' => $validated['title'],
            'content' => $validated['content'], // сохраняем HTML из редактора
        ]);

        return redirect()->route('legal-pages.index')
            ->with('success', 'Страница успешно обновлена.');
    }

    public function destroy(LegalPage $legalPage)
    {
        $legalPage->delete();

        return redirect()->route('legal-pages.index')
            ->with('success', 'Страница успешно удалена.');
    }
}
