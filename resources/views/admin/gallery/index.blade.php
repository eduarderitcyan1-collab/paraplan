<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Галерея</h1>

            <a href="{{ route('gallery.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                Добавить
            </a>
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
                            <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase">Файл</th>
                            <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase">Тип</th>
                            <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase">Порядок</th>
                            <th class="px-6 py-3 text-right text-xs text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm">{{ $item->id }}</td>

                                <td class="px-6 py-4 text-sm">
                                    @if ($item->type === 'photo')
                                        <img src="{{ asset('storage/' . $item->path) }}" class="h-32 w-32 rounded-md object-cover" alt="">
                                    @elseif ($item->type === 'video')
                                        <video class="h-32 w-48 rounded-md" controls muted>
                                            <source src="{{ asset('storage/' . $item->path) }}" type="video/webm">
                                            Ваш браузер не поддерживает видео.
                                        </video>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    {{ $item->type }}
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    {{ $item->order }}
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">

                                    <a href="{{ route('gallery.edit', $item) }}"
                                        class="inline-flex w-28 justify-center px-3 py-1.5 bg-yellow-400 text-white text-xs rounded-md hover:bg-yellow-500">
                                        Редактировать
                                    </a>

                                    <form action="{{ route('gallery.destroy', $item) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Удалить?')"
                                            class="inline-flex w-28 justify-center px-3 py-1.5 bg-red-600 text-white text-xs rounded-md hover:bg-red-700">
                                            Удалить
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                        @if ($items->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                    Записей пока нет
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
