<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Почему мы?</h1>

            <a href="{{ route('whyUs.create') }}"
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Иконка</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Заголовок</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Порядок</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->id }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    @if ($item->svg)
                                        <img src="{{ asset('storage/' . $item->svg) }}" alt="SVG Icon"
                                            class="w-8 h-8 object-contain">
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                    {{ $item->title }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->order }}
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('whyUs.edit', $item) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded-md hover:bg-yellow-500 transition">
                                        Редактировать
                                    </a>

                                    <form action="{{ route('whyUs.destroy', $item) }}" method="POST"
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
