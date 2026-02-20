@csrf

<div class="space-y-4">

    <div>
        <label class="block text-sm font-medium text-gray-700">Заголовок</label>
        <input type="text" name="title" value="{{ old('title', $flyPoint->title ?? '') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Описание</label>
        <textarea id="desc-editor" name="desc" rows="10"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('desc', $flyPoint->desc ?? '') }}</textarea>
        @error('desc')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Ссылка</label>
        <input type="text" name="link" value="{{ old('link', $flyPoint->link ?? '') }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('link')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Порядок</label>
        <input type="number" name="order" value="{{ old('order', $flyPoint->order ?? 0) }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('order')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Изображение</label>
        <input type="file" name="img" class="mt-1 block w-full">
        @if (!empty($flyPoint->img))
            <img src="{{ asset('storage/' . $flyPoint->img) }}" class="w-24 h-24 mt-2 object-contain">
        @endif
        @error('img')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
            Сохранить
        </button>
    </div>

</div>
