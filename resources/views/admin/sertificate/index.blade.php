<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        <div class="flex justify-between mb-6">
            <h1 class="text-2xl font-bold">Сертификаты</h1>
            <a href="{{ route('sertificate.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Добавить
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Изображение</th>
                        <th class="px-4 py-3 text-left">Название</th>
                        <th class="px-4 py-3 text-left">Цена</th>
                        <th class="px-4 py-3 text-left">Порядок</th>
                        <th class="px-4 py-3 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $item->id }}</td>
                            <td class="px-4 py-3">
                                @if ($item->img)
                                    <img src="{{ asset('storage/' . $item->img) }}" class="w-12 h-12 object-contain">
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $item->title }}</td>
                            <td class="px-4 py-3">{{ $item->price }}</td>
                            <td class="px-4 py-3">{{ $item->order }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('sertificate.edit', $item) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded-md hover:bg-yellow-500 transition">
                                    Редактировать
                                </a>

                                <form action="{{ route('sertificate.destroy', $item) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Удалить?')"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 transition">
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($items->isEmpty())
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Записей пока нет
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $items->links() }}
        </div>

    </div>
</x-app-layout>
