@include('admin.partials.layout-start')
<div class="mb-4 flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Галерея (фото/видео)</h1>
    <a href="{{ route('admin.gallery-items.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">Добавить</a>
</div>
@include('admin.partials.flash')
<div class="overflow-hidden rounded bg-white shadow">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-50"><tr><th class="p-3 text-left">Тип</th><th>Ссылка</th><th>Превью</th><th>Порядок</th><th></th></tr></thead>
        <tbody>
        @foreach($items as $item)
            <tr class="border-t"><td class="p-3">{{ $item->type }}</td><td class="max-w-xs truncate">{{ $item->url }}</td><td class="max-w-xs truncate">{{ $item->preview_url }}</td><td>{{ $item->display_order }}</td><td class="space-x-2"><a href="{{ route('admin.gallery-items.edit', $item) }}" class="text-amber-600">Ред.</a><form class="inline" method="POST" action="{{ route('admin.gallery-items.destroy', $item) }}">@csrf @method('DELETE')<button class="text-red-600">Удалить</button></form></td></tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $items->links() }}</div>
@include('admin.partials.layout-end')
