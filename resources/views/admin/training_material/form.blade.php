@if ($errors->any())
    <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
        <ul class="list-disc ml-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $item = $trainingMaterial ?? null;
@endphp

<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Ключ материала</label>
        <input type="text" name="key" value="{{ old('key', $item->key ?? '') }}" required
            placeholder="например: one_text"
            class="w-full border border-gray-300 rounded-lg p-2">
        <p class="text-xs text-gray-500 mt-1">Уникальный ключ латиницей/цифрами/дефисом/подчеркиванием.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
        <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Текст</label>
        <textarea name="body" rows="8" class="w-full border border-gray-300 rounded-lg p-2">{{ old('body', $item->body ?? '') }}</textarea>
        <p class="text-xs text-gray-500 mt-1">Каждый абзац с новой строки.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Медиафайл</label>
        <input type="file" name="media_file" accept="image/webp,video/webm" class="w-full border border-gray-300 rounded-lg p-2">
        <p class="text-xs text-gray-500 mt-1">Только загрузка с сервера: WebP (изображение) до 2 МБ, WebM (видео) до 7 МБ.</p>

        @if (!empty($item?->media_path))
            <div class="mt-3">
                @if ($item->media_type === 'image')
                    <img src="{{ asset('storage/' . $item->media_path) }}" alt="{{ $item->media_alt }}"
                        class="w-32 h-32 object-cover rounded-lg">
                @else
                    <video class="h-32 w-56 rounded-md" controls muted>
                        <source src="{{ asset('storage/' . $item->media_path) }}" type="video/webm">
                        Ваш браузер не поддерживает видео.
                    </video>
                @endif
            </div>

            <label class="inline-flex items-center gap-2 mt-3 text-sm text-gray-700">
                <input type="checkbox" name="remove_media" value="1">
                Удалить текущее медиа
            </label>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">ALT для медиа</label>
        <input type="text" name="media_alt" value="{{ old('media_alt', $item->media_alt ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" name="order" min="1" value="{{ old('order', $item->order ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>
</div>
