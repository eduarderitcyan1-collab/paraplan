@php
    $item = $homeSeoInfo ?? null;
@endphp

<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
        <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Текст</label>
        <textarea id="desc-editor" name="desc" rows="14" class="w-full border border-gray-300 rounded-lg p-2">{{ old('desc', $item->desc ?? '') }}</textarea>
        <p class="text-xs text-gray-500 mt-1">Поддерживаются таблицы, изображения и форматирование.</p>
    </div>
</div>
