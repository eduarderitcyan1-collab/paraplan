<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-gray-800">{{ $page->title }}</h2></x-slot>
    <div class="py-8"><div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
        <div class="mb-4"><a href="{{ route('admin.pages.blocks.index', $page) }}" class="text-indigo-600">Управление блоками</a></div>
        @foreach($page->blocks as $block)
            <div class="mb-3 rounded bg-white p-4 shadow">
                <div class="font-semibold">{{ $block->type }} (#{{ $block->id }})</div>
                <pre class="mt-2 overflow-x-auto text-xs">{{ json_encode($block->content, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) }}</pre>
            </div>
        @endforeach
    </div></div>
</x-app-layout>
