<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlockItemReorderRequest;
use App\Http\Requests\Admin\BlockItemStoreRequest;
use App\Http\Requests\Admin\BlockItemUpdateRequest;
use App\Models\Block;
use App\Models\BlockItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BlockItemController extends Controller
{
    public function index(Block $block): View
    {
        $items = $block->items()->get();

        return view('admin.block-items.index', compact('block', 'items'));
    }

    public function create(Block $block): View
    {
        return view('admin.block-items.create', compact('block'));
    }

    public function store(BlockItemStoreRequest $request, Block $block): RedirectResponse
    {
        $data = $request->safe()->except('payload_json');

        $block->items()->create([
            ...$data,
            'display_order' => $request->integer('display_order', $block->items()->count()),
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.blocks.items.index', $block)->with('status', 'Элемент добавлен.');
    }

    public function edit(Block $block, BlockItem $item): View
    {
        abort_unless($item->block_id === $block->id, 404);

        return view('admin.block-items.edit', compact('block', 'item'));
    }

    public function update(BlockItemUpdateRequest $request, Block $block, BlockItem $item): RedirectResponse
    {
        abort_unless($item->block_id === $block->id, 404);
        $data = $request->safe()->except('payload_json');

        $item->update([
            ...$data,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.blocks.items.index', $block)->with('status', 'Элемент обновлен.');
    }

    public function destroy(Block $block, BlockItem $item): RedirectResponse
    {
        abort_unless($item->block_id === $block->id, 404);
        $item->delete();

        return redirect()->route('admin.blocks.items.index', $block)->with('status', 'Элемент удален.');
    }

    public function reorder(BlockItemReorderRequest $request, Block $block): JsonResponse
    {
        $ids = $request->validated('ordered_ids');
        $count = BlockItem::query()->where('block_id', $block->id)->whereIn('id', $ids)->count();
        abort_if($count !== count($ids), 422, 'Некорректный список.');

        DB::transaction(function () use ($ids, $request): void {
            foreach ($ids as $index => $id) {
                BlockItem::query()->whereKey($id)->update([
                    'display_order' => $index,
                    'updated_by' => $request->user()->id,
                ]);
            }
        });

        return response()->json(['message' => 'Порядок элементов сохранен']);
    }
}
