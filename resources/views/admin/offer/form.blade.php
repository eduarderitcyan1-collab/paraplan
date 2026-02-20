<div class="space-y-6">

    <!-- Изображение -->
    <div>
        <label for="img" class="block text-sm font-medium text-gray-700 mb-1">Изображение</label>
        <input type="file" id="img" name="img" accept="image/*"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('img')" class="mt-1" />

        @if (!empty($offer->img))
            <div class="mt-2">
                <span class="text-gray-500 text-sm">Текущее изображение:</span>
                <div class="mt-1 w-24 h-24">
                    <img src="{{ asset('storage/' . $offer->img) }}" alt="Изображение" class="w-24 h-24 object-contain">
                </div>
            </div>
        @endif
    </div>

    <!-- Заголовок -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
        <input type="text" id="title" name="title" value="{{ old('title', $offer->title ?? '') }}" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    <!-- Описание -->
    <div>
        <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea id="desc" name="desc" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">{{ old('desc', $offer->desc ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('desc')" class="mt-1" />
    </div>

    <!-- Порядок -->
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" id="order" name="order" value="{{ old('order', $offer->order ?? 0) }}"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('order')" class="mt-1" />
    </div>

</div>
