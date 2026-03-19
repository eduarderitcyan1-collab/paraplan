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
    $item = $seoPage ?? null;
@endphp

<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">URL страницы</label>
        <input type="text" name="url" value="{{ old('url', $item->url ?? '') }}" required
            placeholder="/about или https://site.ru/about"
            class="w-full border border-gray-300 rounded-lg p-2">
        <p class="text-xs text-gray-500 mt-1">Можно указывать полный URL с доменом или относительный путь.</p>
    </div>

    <div>
        <input type="hidden" name="indexing_enabled" value="0">
        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="indexing_enabled" value="1"
                {{ old('indexing_enabled', $item->indexing_enabled ?? true) ? 'checked' : '' }}>
            Включить индексацию этой страницы
        </label>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Meta title</label>
        <input type="text" name="meta_title" value="{{ old('meta_title', $item->meta_title ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Meta description</label>
        <textarea name="meta_description" rows="4" class="w-full border border-gray-300 rounded-lg p-2">{{ old('meta_description', $item->meta_description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Meta keywords</label>
        <textarea name="meta_keywords" rows="3" class="w-full border border-gray-300 rounded-lg p-2">{{ old('meta_keywords', $item->meta_keywords ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Canonical URL</label>
        <input type="text" name="canonical_url" value="{{ old('canonical_url', $item->canonical_url ?? '') }}"
            placeholder="https://site.ru/about"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">OG title</label>
        <input type="text" name="og_title" value="{{ old('og_title', $item->og_title ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">OG description</label>
        <textarea name="og_description" rows="4" class="w-full border border-gray-300 rounded-lg p-2">{{ old('og_description', $item->og_description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">OG-изображение (WebP)</label>
        <input type="file" name="og_image_file" accept="image/webp" class="w-full border border-gray-300 rounded-lg p-2">
        <p class="text-xs text-gray-500 mt-1">Только WebP, максимум 2 МБ.</p>

        @if (!empty($item?->og_image_path))
            <div class="mt-3">
                <img src="{{ asset('storage/' . $item->og_image_path) }}" alt="{{ $item->og_image_alt }}"
                    class="w-40 h-24 object-cover rounded-lg">
            </div>

            <label class="inline-flex items-center gap-2 mt-3 text-sm text-gray-700">
                <input type="checkbox" name="remove_og_image" value="1">
                Удалить текущее OG-изображение
            </label>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">ALT для OG-изображения</label>
        <input type="text" name="og_image_alt" value="{{ old('og_image_alt', $item->og_image_alt ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>
</div>
