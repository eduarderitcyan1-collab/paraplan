<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 space-y-6">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-gray-800">Скрипты на сайт</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('seo-pages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Назад к SEO</a>
                <a href="{{ route('external-services.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">Добавить скрипт</a>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Название</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ключ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($items as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $item->key ?: '—' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($item->active)
                                        <span class="inline-flex items-center px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-medium">Активно</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-medium">Отключено</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('external-services.edit', $item) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded-md hover:bg-yellow-500 transition">Редактировать</a>
                                    <form action="{{ route('external-services.destroy', $item) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Удалить скрипт?')" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 transition">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">Скриптов пока нет</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $items->links() }}
        </div>
    </div>
</x-app-layout>
