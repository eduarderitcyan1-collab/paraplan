<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlockReorderRequest;
use App\Http\Requests\Admin\BlockStoreRequest;
use App\Http\Requests\Admin\BlockUpdateRequest;
use App\Models\Block;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BlockController extends Controller
{
    public function index(): View
    {
        $blocks = Block::query()->withCount('items')->orderBy('display_order')->paginate(20);

        return view('admin.blocks.index', compact('blocks'));
    }

    public function create(): View
    {
        $definitions = Block::definitions();

        return view('admin.blocks.create', compact('definitions'));
    }

    public function store(BlockStoreRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('schema_json');
        Block::create([
            ...$data,
            'is_active' => (bool) $request->boolean('is_active', true),
            'created_by' => $request->user()->id,
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.blocks.index')->with('status', 'Блок создан.');
    }

    public function show(Block $block): View
    {
        $block->load('items');

        return view('admin.blocks.show', compact('block'));
    }

    public function edit(Block $block): View
    {
        $definitions = Block::definitions();

        return view('admin.blocks.edit', compact('block', 'definitions'));
    }

    public function update(BlockUpdateRequest $request, Block $block): RedirectResponse
    {
        $data = $request->safe()->except('schema_json');
        $block->update([
            ...$data,
            'is_active' => (bool) $request->boolean('is_active', false),
            'updated_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.blocks.index')->with('status', 'Блок обновлен.');
    }

    public function destroy(Block $block): RedirectResponse
    {
        $block->delete();

        return redirect()->route('admin.blocks.index')->with('status', 'Блок удален.');
    }

    public function reorder(BlockReorderRequest $request): JsonResponse
    {
        $ids = $request->validated('ordered_ids');

        DB::transaction(function () use ($ids, $request): void {
            foreach ($ids as $index => $id) {
                Block::query()->whereKey($id)->update([
                    'display_order' => $index,
                    'updated_by' => $request->user()->id,
                ]);
            }
        });

        return response()->json(['message' => 'Порядок блоков сохранен']);
    }
}
