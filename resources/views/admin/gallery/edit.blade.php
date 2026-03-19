<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold mb-6">Редактировать</h1>

        <form action="{{ route('gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <div class="text-sm font-medium text-gray-700">Текущий файл</div>

                @if ($gallery->type === 'photo')
                    <img src="{{ asset('storage/' . $gallery->path) }}" alt="" class="h-40 rounded-lg" />
                @else
                    <video class="h-40 rounded-lg" controls>
                        <source src="{{ asset('storage/' . $gallery->path) }}" type="video/webm">
                        Ваш браузер не поддерживает видеотег.
                    </video>
                @endif

                <div class="text-xs text-gray-500">
                    Если не менять файл, оставьте поле загрузки пустым.
                </div>
            </div>

            <label class="block">
                <span class="text-sm font-medium text-gray-700">Загрузить новый файл</span>
                <input type="file" name="file" accept="image/webp,video/webm"
                    class="w-full border border-gray-300 rounded-lg p-2" />
                <p class="text-xs text-gray-500 mt-1">Фото: WebP до 2 МБ. Видео: WebM до 7 МБ.</p>
            </label>

            <label class="block">
                <span class="text-sm font-medium text-gray-700">Порядок (необязательно)</span>
                <input type="number" name="order" value="{{ $gallery->order }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
            </label>

            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Обновить
            </button>
        </form>

    </div>
</x-app-layout>
