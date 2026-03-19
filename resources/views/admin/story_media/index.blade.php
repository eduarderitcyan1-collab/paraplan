<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Медиа истории</h1>
                <p class="text-sm text-gray-600 mt-1">История: {{ $story->title }}</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('stories.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                    К историям
                </a>
                <a href="{{ route('stories.media.create', $story) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                    Добавить медиа
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Файл</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Тип</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Сортировка</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @if ($item->type === 'photo')
                                        <img src="{{ asset('storage/' . $item->path) }}" alt="photo"
                                            class="h-24 w-24 rounded-md object-cover">
                                    @else
                                        <video class="h-24 w-40 rounded-md" controls muted>
                                            <source src="{{ asset('storage/' . $item->path) }}">
                                            Ваш браузер не поддерживает видео.
                                        </video>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->type }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $item->sort }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('stories.media.edit', [$story, $item]) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded-md hover:bg-yellow-500 transition">
                                        Редактировать
                                    </a>

                                    <form action="{{ route('stories.media.destroy', [$story, $item]) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Удалить медиа?')"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 transition">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($items->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                    Медиа пока нет
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $items->links() }}
        </div>
    </div>
</x-app-layout>
