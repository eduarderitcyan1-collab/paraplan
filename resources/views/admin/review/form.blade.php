<div>
    <label class="block text-sm font-medium mb-1">Заголовок</label>
    <input type="text" name="title" value="{{ old('title', $review->title ?? '') }}"
        class="w-full border-gray-300 rounded-lg shadow-sm">
</div>

<div>
    <label class="block text-sm font-medium mb-1">Описание</label>
    <textarea name="desc" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('desc', $review->desc ?? '') }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium mb-1">Порядок</label>
    <input type="number" name="order" value="{{ old('order', $review->order ?? '') }}"
        class="w-full border-gray-300 rounded-lg shadow-sm">
</div>

<div>
    <label class="block text-sm font-medium mb-1">Фотографии</label>
    <input type="file" name="photos[]" multiple class="w-full border-gray-300 rounded-lg shadow-sm mb-4">
</div>

@if (isset($review) && $review->photos->isNotEmpty())
    <div class="grid grid-cols-3 gap-4 mb-4">
        @foreach ($review->photos as $photo)
            <div class="relative group" id="photo-{{ $photo->id }}">
                <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-32 object-cover rounded-lg">

                <button type="button" onclick="deletePhoto({{ $photo->id }})"
                    class="absolute top-1 left-1 bg-red-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                    Удалить
                </button>

                <input type="hidden" name="delete_photos[]" id="delete-photo-{{ $photo->id }}">
            </div>
        @endforeach
    </div>
@endif


<div class="pt-4">
    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
        Сохранить
    </button>
</div>

<script>
    function deletePhoto(id) {
        document.getElementById('delete-photo-' + id).value = id;
        document.getElementById('photo-' + id).style.opacity = '0.5';
    }
</script>
