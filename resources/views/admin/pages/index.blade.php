<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Страницы</h2>
            <a href="{{ route('admin.pages.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">Создать</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            @include('admin.partials.flash')
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead><tr><th class="p-3 text-left">Название</th><th>Slug</th><th>Статус</th><th>Блоки</th><th></th></tr></thead>
                    <tbody class="divide-y divide-gray-100">
                    @foreach($pages as $page)
                        <tr>
                            <td class="p-3">{{ $page->title }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>{{ $page->status }}</td>
                            <td>{{ $page->blocks_count }}</td>
                            <td class="space-x-2 text-right pr-3">
                                <a class="text-indigo-600" href="{{ route('admin.pages.show', $page) }}">Открыть</a>
                                <a class="text-blue-600" href="{{ route('admin.pages.blocks.index', $page) }}">Блоки</a>
                                <a class="text-yellow-600" href="{{ route('admin.pages.edit', $page) }}">Редактировать</a>
                                <form method="POST" class="inline" action="{{ route('admin.pages.destroy', $page) }}">@csrf @method('DELETE')<button class="text-red-600" onclick="return confirm('Удалить?')">Удалить</button></form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $pages->links() }}</div>
        </div>
    </div>
</x-app-layout>
