<form action="{{ $route }}" method="POST" enctype="multipart/form-data"
    class="bg-white shadow rounded-xl p-6 space-y-6">

    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label class="block mb-2 font-medium text-gray-700">Изображение</label>

        @if ($team && $team->img)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $team->img) }}" class="w-24 h-24 object-cover rounded-lg">
            </div>
        @endif

        <input type="file" name="img"
            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500">
        <x-input-error :messages="$errors->get('img')" class="mt-1" />
    </div>

    <div>
        <label class="block mb-2 font-medium text-gray-700">ФИО</label>
        <input type="text" name="title" value="{{ old('title', $team->title ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500">
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    <div>
        <label class="block mb-2 font-medium text-gray-700">Должность</label>
        <input type="text" name="desc" value="{{ old('desc', $team->desc ?? '') }}" required
            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500">
        <x-input-error :messages="$errors->get('desc')" class="mt-1" />
    </div>

    <div>
        <label class="block mb-2 font-medium text-gray-700">Порядок</label>
        <input type="number" name="order" value="{{ old('order', $team->order ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500">
        <x-input-error :messages="$errors->get('order')" class="mt-1" />
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            Сохранить
        </button>
    </div>
</form>
