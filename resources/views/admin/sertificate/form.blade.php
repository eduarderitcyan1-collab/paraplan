<div class="space-y-6">

    <!-- Изображение -->
    <div>
        <label for="img_file" class="block text-sm font-medium text-gray-700 mb-1">Изображение</label>
        <input type="file" id="img_file" name="img_file" accept="image/*"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('img_file')" class="mt-1" />

        @if (!empty($sertificate->img ?? ''))
            <div class="mt-2">
                <span class="text-gray-500 text-sm">Текущее изображение:</span>
                <div class="mt-1 w-24 h-24">
                    <img src="{{ asset('storage/' . $sertificate->img) }}" alt="Изображение"
                        class="w-24 h-24 object-contain rounded-lg">
                </div>
            </div>
        @endif
    </div>

    <!-- Название -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Название</label>
        <input type="text" id="title" name="title" value="{{ old('title', $sertificate->title ?? '') }}"
            required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    <!-- Цена -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Цена</label>
        <input type="number" id="price" name="price" value="{{ old('price', $sertificate->price ?? 0) }}"
            required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('price')" class="mt-1" />
    </div>

    <!-- Порядок -->
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" id="order" name="order" value="{{ old('order', $sertificate->order ?? 0) }}"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('order')" class="mt-1" />
    </div>

</div>
