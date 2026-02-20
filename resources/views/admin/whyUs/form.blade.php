<div class="space-y-6">

    <!-- SVG Upload -->
    <div>
        <label for="svg_file" class="block text-sm font-medium text-gray-700 mb-1">Иконка SVG</label>
        <input type="file" id="svg_file" name="svg_file" accept=".svg"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('svg_file')" class="mt-1" />

        @if (!empty($whyUs->svg))
            <div class="mt-2">
                <span class="text-gray-500 text-sm">Текущая иконка:</span>
                <div class="mt-1 w-12 h-12">
                    <img src="{{ asset('storage/' . $whyUs->svg) }}" alt="SVG Icon" class="w-12 h-12 object-contain">
                </div>
            </div>
        @endif
    </div>

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
        <input type="text" id="title" name="title" value="{{ old('title', $whyUs->title ?? '') }}" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    <!-- Description -->
    <div>
        <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea id="desc" name="desc" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">{{ old('desc', $whyUs->desc ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('desc')" class="mt-1" />
    </div>

    <!-- Order -->
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" id="order" name="order" value="{{ old('order', $whyUs->order ?? 0) }}"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700" />
        <x-input-error :messages="$errors->get('order')" class="mt-1" />
    </div>

</div>
