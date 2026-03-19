@if ($errors->any())
    <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
        <ul class="list-disc ml-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
        <input type="text" name="title" value="{{ old('title', $story->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Превью (WebP, макс. 2МБ)</label>
        <input type="file" name="preview" accept="image/webp"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 text-sm text-gray-700">

        @if (!empty($story->preview))
            <img src="{{ asset('storage/' . $story->preview) }}" class="mt-2 w-32 h-32 object-cover rounded-lg shadow"
                alt="preview">
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Цвет рамки</label>
        <input type="color" name="border_color"
            value="{{ old('border_color', $story->border_color ?? '#000000') }}"
            class="w-16 h-10 border border-gray-300 rounded-lg p-0">
    </div>

    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input id="is_active" type="checkbox" name="is_active" value="1"
            @checked(old('is_active', $story->is_active ?? true)) class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
        <label for="is_active" class="text-sm text-gray-700">Активна</label>
    </div>
</div>
