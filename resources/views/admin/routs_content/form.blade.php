<div class="space-y-6">

    <!-- Route -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Маршрут</label>
        <select name="routs_id"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">
            @foreach ($routes as $route)
                <option value="{{ $route->id }}"
                    {{ old('routs_id', $routsContent->routs_id ?? '') == $route->id ? 'selected' : '' }}>
                    {{ $route->title }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Title -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Название</label>
        <input type="text" name="title" value="{{ old('title', $routsContent->title ?? '') }}" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
        <input type="text" id="slug" name="slug" value="{{ old('slug', $routsContent->slug ?? '') }}"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">
    </div>

    <!-- Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea name="desc" id="desc-editor"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">{{ old('desc', $routsContent->desc ?? '') }}</textarea>
    </div>

    <!-- Main Photo -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Главное фото</label>
        <input type="file" name="photo"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 text-sm text-gray-700">
        @if (!empty($routsContent->photo))
            <img src="{{ asset('storage/' . $routsContent->photo) }}"
                class="mt-2 w-32 h-32 object-cover rounded-lg shadow">
        @endif
    </div>

    <!-- Characteristics -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Характеристики</label>

        <div id="characteristics-container" class="space-y-2">
            @php $chars = old('characteristics', $routsContent->characteristics ?? []) @endphp
            @foreach ($chars as $index => $char)
                <div class="flex gap-2">
                    <input type="text" name="characteristics[{{ $index }}][property]"
                        value="{{ $char['property'] ?? '' }}" placeholder="Свойство"
                        class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">

                    <input type="text" name="characteristics[{{ $index }}][value]"
                        value="{{ $char['value'] ?? '' }}" placeholder="Значение"
                        class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">

                    <button type="button" onclick="this.parentNode.remove()"
                        class="px-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">×</button>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addCharacteristic()"
            class="mt-2 px-4 py-1 bg-indigo-600 text-white text-sm rounded-lg shadow hover:bg-indigo-700 transition">
            Добавить
        </button>
    </div>

    <!-- Advantages -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Преимущества</label>

        <div id="advantages-container" class="space-y-2">
            @php $advantages = old('advantages', $routsContent->advantages ?? []) @endphp
            @foreach ($advantages as $index => $adv)
                <div class="flex gap-2">
                    <input type="text" name="advantages[{{ $index }}][title]"
                        value="{{ $adv['title'] ?? '' }}" placeholder="Заголовок"
                        class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">

                    <input type="text" name="advantages[{{ $index }}][description]"
                        value="{{ $adv['description'] ?? '' }}" placeholder="Описание"
                        class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">

                    <button type="button" onclick="this.parentNode.remove()"
                        class="px-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">×</button>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="addAdvantage()"
            class="mt-2 px-4 py-1 bg-indigo-600 text-white text-sm rounded-lg shadow hover:bg-indigo-700 transition">
            Добавить
        </button>
    </div>

    <!-- Gallery -->
    @if (!empty($routsContent->gallery))
        <div id="gallery-container" class="flex gap-3 mt-3 flex-wrap">

            @foreach ($routsContent->gallery->sortBy('order') as $img)
                <div class="relative group cursor-move" data-id="{{ $img->id }}">

                    <img src="{{ asset('storage/' . $img->path) }}"
                        class="w-24 h-24 object-cover rounded-lg shadow transition duration-200">

                    <!-- Кнопка удаления -->
                    <button type="button" onclick="markForDelete({{ $img->id }})"
                        class="absolute -top-2 -right-2 bg-red-600 text-white 
                       w-6 h-6 rounded-full text-xs hidden 
                       group-hover:flex items-center justify-center">
                        ×
                    </button>

                    <!-- Скрытое поле порядка -->
                    <input type="hidden" name="gallery_order[]" value="{{ $img->id }}">

                </div>
            @endforeach

        </div>
    @endif

    <!-- Order -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" name="order" value="{{ old('order', $routsContent->order ?? 0) }}"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 text-sm text-gray-700">
    </div>

</div>

<script>
    let charIndex = {{ count($chars ?? []) }};

    function addCharacteristic() {
        const container = document.getElementById('characteristics-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
        <input type="text" name="characteristics[${charIndex}][property]" placeholder="Свойство"
            class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">
        <input type="text" name="characteristics[${charIndex}][value]" placeholder="Значение"
            class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">
        <button type="button" onclick="this.parentNode.remove()"
            class="px-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">×</button>
    `;
        container.appendChild(div);
        charIndex++;
    }

    let advIndex = {{ count($advantages ?? []) }};

    function addAdvantage() {
        const container = document.getElementById('advantages-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
        <input type="text" name="advantages[${advIndex}][title]" placeholder="Заголовок"
            class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">
        <input type="text" name="advantages[${advIndex}][description]" placeholder="Описание"
            class="flex-1 border border-gray-300 rounded-lg p-2 text-sm">
        <button type="button" onclick="this.parentNode.remove()"
            class="px-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">×</button>
    `;
        container.appendChild(div);
        advIndex++;
    }

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
