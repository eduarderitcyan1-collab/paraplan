<div class="space-y-6">

    <!-- Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Изображение</label>
        <input type="file" name="img_file" accept=".jpg,.jpeg,.png,.svg"
            class="block w-full border border-gray-300 rounded-lg p-2 text-sm">

        @if (!empty($service->img ?? ''))
            <div class="mt-2 w-24 h-24">
                <img src="{{ asset('storage/' . $service->img) }}" class="w-24 h-24 object-contain rounded">
            </div>
        @endif
    </div>

    <!-- Title -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Название</label>
        <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <!-- Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea name="desc" required class="w-full border border-gray-300 rounded-lg p-2">{{ old('desc', $service->desc ?? '') }}</textarea>
    </div>

    <!-- Price -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Цена</label>
        <input type="number" name="price" value="{{ old('price', $service->price ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <!-- Link -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Ссылка (необязательно)</label>
        <input type="url" name="link" value="{{ old('link', $service->link ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <!-- Order -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" name="order" value="{{ old('order', $service->order ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

</div>
