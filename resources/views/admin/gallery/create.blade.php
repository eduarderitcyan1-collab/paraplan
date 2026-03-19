<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold mb-6">Добавить</h1>

        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow space-y-4">
            @csrf

            <label class="block">
                <span class="text-sm font-medium text-gray-700">Файлы</span>
                <input type="file" name="file[]" accept="image/webp,video/webm" multiple required
                    class="w-full border border-gray-300 rounded-lg p-2" />
                <p class="text-xs text-gray-500 mt-1">Фото: WebP до 2 МБ. Видео: WebM до 7 МБ. Можно выбрать сразу несколько файлов.</p>
            </label>

            <label class="block">
                <span class="text-sm font-medium text-gray-700">Порядок (необязательно)</span>
                <input type="number" name="order" placeholder="Порядок"
                    class="w-full border border-gray-300 rounded-lg p-2">
            </label>

            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Сохранить
            </button>
        </form>

    </div>
</x-app-layout>
