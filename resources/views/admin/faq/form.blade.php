<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Вопрос (title)</label>
        <input type="text" name="title" value="{{ old('title', $faq->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Ответ (desc)</label>
        <textarea id="desc-editor" name="desc" rows="12" class="w-full border border-gray-300 rounded-lg p-2">{{ old('desc', $faq->desc ?? '') }}</textarea>
        <p class="text-xs text-gray-500 mt-1">Поддерживаются таблицы, изображения и форматирование.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Порядок (order)</label>
        <input type="number" min="1" name="order" value="{{ old('order', $faq->order ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>
</div>
