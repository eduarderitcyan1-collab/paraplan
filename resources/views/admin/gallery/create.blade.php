<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold mb-6">Добавить</h1>

        <form action="{{ route('gallery.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow space-y-4">
            @csrf

            <input type="text" name="path" placeholder="Путь" class="w-full border border-gray-300 rounded-lg p-2"
                required>

            <input type="number" name="order" placeholder="Порядок"
                class="w-full border border-gray-300 rounded-lg p-2">

            <select name="type" class="w-full border border-gray-300 rounded-lg p-2">
                <option value="photo">Фото</option>
                <option value="video">Видео</option>
            </select>

            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Сохранить
            </button>
        </form>

    </div>
</x-app-layout>
