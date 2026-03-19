<div class="space-y-6">

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
        <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Главное фото</label>
        <input type="file" name="img"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 text-sm text-gray-700">
        @if (!empty($article->img))
            <img src="{{ asset('storage/' . $article->img) }}" class="mt-2 w-32 h-32 object-cover rounded-lg shadow">
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $article->slug ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea name="desc" id="desc-editor" class="w-full border border-gray-300 rounded-lg p-2">{{ old('desc', $article->desc ?? '') }}</textarea>
    </div>

    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Галерея</label>
        <input type="file" name="gallery[]" multiple class="w-full border border-gray-300 rounded-lg p-2">
    </div>


    @if (!empty($article->gallery) && $article->gallery->isNotEmpty())
        <div id="gallery-container" class="flex gap-3 mt-3 flex-wrap">
            @foreach ($article->gallery->sortBy('order') as $img)
                <div class="relative group cursor-move" data-id="{{ $img->id }}">
                    <img src="{{ asset('storage/' . $img->path) }}"
                        class="w-24 h-24 object-cover rounded-lg shadow transition duration-200">

                    <button type="button" onclick="markForDelete({{ $img->id }})"
                        class="absolute -top-2 -right-2 bg-red-600 text-white 
                    w-6 h-6 rounded-full text-xs hidden 
                    group-hover:flex items-center justify-center">
                        ×
                    </button>

                    <input type="hidden" name="gallery_order[]" value="{{ $img->id }}">
                </div>
            @endforeach
        </div>
    @endif

    <div id="deleted-images"></div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" name="order" value="{{ old('order', $article->order ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
    </div>

</div>

<script>
    let deletedImages = [];

    function markForDelete(id) {

        if (deletedImages.includes(id)) {
            // если нажали повторно — отмена удаления
            deletedImages = deletedImages.filter(item => item !== id);

            let el = document.querySelector(`[data-id='${id}'] img`);
            el.classList.remove('opacity-50');

            document.querySelector(`#deleted-input-${id}`)?.remove();
            return;
        }

        deletedImages.push(id);

        let el = document.querySelector(`[data-id='${id}'] img`);
        el.classList.add('opacity-50');

        // создаём скрытый input
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_gallery[]';
        input.value = id;
        input.id = `deleted-input-${id}`;

        document.getElementById('deleted-images').appendChild(input);
    }
</script>
