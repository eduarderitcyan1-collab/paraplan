<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
    <input type="text" name="title" value="{{ old('title', $about->title ?? '') }}"
        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
    <textarea id="desc-editor" name="desc" rows="10"
        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('desc', $about->desc ?? '') }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Видео (формат webM, максимум 4MB)
    </label>

    <input type="file" name="video" accept="video/webm"
        class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

    @if (isset($about->video) && $about->video)
        <div class="mt-4">
            <p class="text-sm text-gray-600 mb-2">Текущее видео:</p>
            <video width="300" controls class="rounded-lg shadow">
                <source src="{{ asset('storage/' . $about->video) }}" type="video/webm">
            </video>
        </div>
    @endif
</div>

<div class="pt-4">
    <button type="submit"
        class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
        Сохранить
    </button>
</div>
