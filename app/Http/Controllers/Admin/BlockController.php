<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlockReorderRequest;
use App\Http\Requests\Admin\BlockStoreRequest;
use App\Http\Requests\Admin\BlockUpdateRequest;
use App\Models\Block;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BlockController extends Controller
{
    public function index(Page $page): View
    {
        $blocks = $page->blocks()->with('media')->get();

        return view('admin.blocks.index', compact('page', 'blocks'));
    }

    public function create(Page $page): View
    {
        $blockTypes = Block::allowedTypes();

        return view('admin.blocks.create', compact('page', 'blockTypes'));
    }

    public function store(BlockStoreRequest $request, Page $page): RedirectResponse
    {
        $data = $request->safe()->except('content_json');

        $page->blocks()->create([
            ...$data,
            'display_order' => $request->integer('display_order', $page->blocks()->count()),
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.pages.blocks.index', $page)->with('status', 'Блок добавлен.');
    }

    public function edit(Page $page, Block $block): View
    {
        abort_unless($block->page_id === $page->id, 404);

        $blockTypes = Block::allowedTypes();

        return view('admin.blocks.edit', compact('page', 'block', 'blockTypes'));
    }

    public function update(BlockUpdateRequest $request, Page $page, Block $block): RedirectResponse
    {
        abort_unless($block->page_id === $page->id, 404);

        $data = $request->safe()->except('content_json');

        $block->update([
            ...$data,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.pages.blocks.index', $page)->with('status', 'Блок обновлен.');
    }

    public function destroy(Page $page, Block $block): RedirectResponse
    {
        abort_unless($block->page_id === $page->id, 404);

        $block->delete();

        return redirect()->route('admin.pages.blocks.index', $page)->with('status', 'Блок удален.');
    }

    public function reorder(BlockReorderRequest $request, Page $page): JsonResponse
    {
        $ids = $request->validated('ordered_ids');

        $count = Block::query()->where('page_id', $page->id)->whereIn('id', $ids)->count();
        abort_if($count !== count($ids), 422, 'Некорректный список блоков.');

        DB::transaction(function () use ($ids, $request): void {
            foreach ($ids as $index => $id) {
                Block::query()->whereKey($id)->update([
                    'display_order' => $index,
                    'updated_by' => $request->user()->id,
                ]);
            }
        });

        return response()->json(['message' => 'Порядок сохранен.']);
    }
}
