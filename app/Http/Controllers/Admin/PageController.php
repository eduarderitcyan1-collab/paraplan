<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageStoreRequest;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::query()->withCount('blocks')->orderBy('display_order')->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function store(PageStoreRequest $request): RedirectResponse
    {
        Page::create([
            ...$request->validated(),
            'display_order' => $request->integer('display_order', 0),
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Страница создана.');
    }

    public function show(Page $page): View
    {
        $page->load(['blocks.media']);

        return view('admin.pages.show', compact('page'));
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(PageUpdateRequest $request, Page $page): RedirectResponse
    {
        $page->update([
            ...$request->validated(),
            'display_order' => $request->integer('display_order', $page->display_order),
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Страница обновлена.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('status', 'Страница удалена.');
    }
}
