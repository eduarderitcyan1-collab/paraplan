<div class="space-y-6">

    <!-- Image Upload -->
    <div>
        <label for="img_file" class="block text-sm font-medium text-gray-700 mb-1">Изображение</label>
        <input type="file" id="img_file" name="img_file" accept=".jpg,.jpeg,.png,.svg"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('img_file')" class="mt-1" />

        @if (!empty($tarif->img ?? ''))
            <div class="mt-2">
                <span class="text-gray-500 text-sm">Текущее изображение:</span>
                <div class="w-24 h-24 mt-1">
                    <img src="{{ asset('storage/' . $tarif->img) }}" alt="img"
                        class="w-24 h-24 object-contain rounded-md">
                </div>
            </div>
        @endif
    </div>

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Название</label>
        <input type="text" id="title" name="title" value="{{ old('title', $tarif->title ?? '') }}" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    <!-- Time -->
    <div>
        <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Время</label>
        <input type="text" id="time" name="time" value="{{ old('time', $tarif->time ?? '') }}" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('time')" class="mt-1" />
    </div>

    <!-- Price -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Цена</label>
        <input type="text" id="price" name="price" value="{{ old('price', $tarif->price ?? '') }}" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('price')" class="mt-1" />
    </div>

    <!-- Order -->
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" id="order" name="order" value="{{ old('order', $tarif->order ?? '') }}"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('order')" class="mt-1" />
    </div>


</div>
