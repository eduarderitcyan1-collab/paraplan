<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 space-y-6">

        <div class="flex justify-between items-center gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-gray-800">SEO</h1>
            <div class="flex items-center gap-2">
                @if ($homeSeoInfo)
                    <a href="{{ route('home-seo-info.edit', $homeSeoInfo) }}"
                        class="inline-flex items-center px-4 py-2 bg-sky-600 text-white text-sm font-medium rounded-lg shadow hover:bg-sky-700 transition">
                        SEO инфа на главной: редактировать
                    </a>
                @else
                    <a href="{{ route('home-seo-info.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-sky-600 text-white text-sm font-medium rounded-lg shadow hover:bg-sky-700 transition">
                        SEO инфа на главной: создать
                    </a>
                @endif

                <a href="{{ route('seo-pages.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                    Добавить SEO-страницу
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Глобальная индексация</h2>

            <form action="{{ route('seo-pages.global-indexing.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <p class="text-sm font-medium text-gray-700">Глобальная индексация сайта</p>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="global_indexing_enabled" value="1"
                            {{ old('global_indexing_enabled', $settings->global_indexing_enabled) ? 'checked' : '' }}>
                        Включена
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="global_indexing_enabled" value="0"
                            {{ !old('global_indexing_enabled', $settings->global_indexing_enabled) ? 'checked' : '' }}>
                        Отключена
                    </label>
                </div>

                <div class="space-y-2">
                    <p class="text-sm font-medium text-gray-700">Favicon сайта</p>
                    <input type="file" name="favicon_file" accept=".ico,image/x-icon,image/vnd.microsoft.icon,image/png,image/svg+xml,image/webp"
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                    <p class="text-xs text-gray-500">Поддерживаются форматы: ICO, PNG, SVG, WebP. Максимум 1 МБ.</p>

                    @if (!empty($settings->favicon_path))
                        <div class="flex items-center gap-3 mt-2">
                            <img src="{{ asset('storage/' . $settings->favicon_path) }}" alt="Текущий favicon" class="w-8 h-8 rounded border border-gray-200 object-contain bg-white">
                            <span class="text-xs text-gray-500">Текущий favicon активен на сайте.</span>
                        </div>

                        <label class="inline-flex items-center gap-2 text-sm text-gray-700 mt-2">
                            <input type="checkbox" name="remove_favicon" value="1">
                            Удалить текущий favicon
                        </label>
                    @endif
                </div>

                <div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">URL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Индексация</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Meta title</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div>{{ $item->url }}</div>
                                    <div class="text-xs text-gray-400">{{ $item->normalized_url }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($item->indexing_enabled)
                                        <span class="inline-flex items-center px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-medium">Вкл</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-medium">Выкл</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->meta_title ?: '—' }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('seo-pages.edit', $item) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded-md hover:bg-yellow-500 transition">
                                        Редактировать
                                    </a>

                                    <form action="{{ route('seo-pages.destroy', $item) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Удалить SEO запись?')"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 transition">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($items->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                    SEO-записей пока нет
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $items->links() }}
        </div>
    </div>
</x-app-layout>
