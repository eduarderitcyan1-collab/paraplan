<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Блоки страницы: {{ $page->title }}</h2>
            <a href="{{ route('admin.pages.blocks.create', $page) }}" class="rounded bg-indigo-600 px-4 py-2 text-white">Добавить блок</a>
        </div>
    </x-slot>

    <div class="py-8"><div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
        @include('admin.partials.flash')
        <ul id="sortable-blocks" class="space-y-3">
            @foreach($blocks as $block)
                <li draggable="true" data-id="{{ $block->id }}" class="cursor-move rounded bg-white p-4 shadow">
                    <div class="flex justify-between">
                        <div><b>{{ $block->type }}</b> · order: {{ $block->display_order }}</div>
                        <div class="space-x-2">
                            <a class="text-yellow-600" href="{{ route('admin.pages.blocks.edit', [$page, $block]) }}">Ред.</a>
                            <form class="inline" method="POST" action="{{ route('admin.pages.blocks.destroy', [$page, $block]) }}">@csrf @method('DELETE')<button class="text-red-600">Удалить</button></form>
                        </div>
                    </div>
                    <pre class="mt-2 text-xs">{{ json_encode($block->content, JSON_UNESCAPED_UNICODE) }}</pre>
                </li>
            @endforeach
        </ul>
        <button id="save-order" class="mt-4 rounded bg-green-600 px-4 py-2 text-white">Сохранить порядок</button>
    </div></div>

    <script>
        const list = document.getElementById('sortable-blocks');
        let dragItem = null;

        list.querySelectorAll('li').forEach(item => {
            item.addEventListener('dragstart', () => dragItem = item);
            item.addEventListener('dragover', e => e.preventDefault());
            item.addEventListener('drop', e => {
                e.preventDefault();
                if (dragItem && dragItem !== item) {
                    const rect = item.getBoundingClientRect();
                    const next = (e.clientY - rect.top) > (rect.height / 2);
                    item.parentNode.insertBefore(dragItem, next ? item.nextSibling : item);
                }
            });
        });

        document.getElementById('save-order').addEventListener('click', async () => {
            const orderedIds = [...list.querySelectorAll('li')].map(li => Number(li.dataset.id));
            const res = await fetch('{{ route('admin.pages.blocks.reorder', $page) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ ordered_ids: orderedIds }),
            });
            alert(res.ok ? 'Порядок сохранен' : 'Ошибка сохранения');
            if (res.ok) window.location.reload();
        });
    </script>
</x-app-layout>
