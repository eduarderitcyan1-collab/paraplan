<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            {{ $page->exists ? 'Редактировать страницу' : 'Создать страницу' }}
        </h1>

        <form action="{{ $page->exists ? route('legal-pages.update', $page) : route('legal-pages.store') }}"
            method="POST" class="space-y-6">
            @csrf
            @if($page->exists)
                @method('PUT')
            @endif

            <!-- Ключ -->
            <div>
                <label for="key" class="block text-sm font-medium text-gray-700 mb-1">Ключ</label>

                @if($page->exists)
                    <input type="text" id="key" name="key"
                        class="block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 sm:text-sm"
                        value="{{ $page->key }}" readonly>
                @else
                    <select id="key" name="key"
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('key') border-red-500 @enderror"
                        required>
                        @foreach($availableKeys as $key)
                            <option value="{{ $key }}" {{ old('key') == $key ? 'selected' : '' }}>
                                {{ $key === \App\Models\LegalPage::KEY_PRIVACY ? 'Политика конфиденциальности' : 'Согласие на обработку данных' }}
                            </option>
                        @endforeach
                    </select>
                    @error('key')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                @endif
            </div>

            <!-- Заголовок -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
                <input type="text" name="title" id="title"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('title') border-red-500 @enderror"
                    value="{{ old('title', $page->title) }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Содержание с Tiny -->
            <div>
                <label for="desc-editor" class="block text-sm font-medium text-gray-700 mb-1">Содержание</label>
                <textarea id="desc-editor" name="content" rows="12"
                    class="w-full border border-gray-300 rounded-lg p-2">{{ old('content', $page->content) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Поддерживаются таблицы, изображения и форматирование.</p>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Кнопки -->
            <div class="flex items-center space-x-3">
                @if($page->exists || !empty($availableKeys))
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 transition">
                        {{ $page->exists ? 'Обновить' : 'Создать' }}
                    </button>
                @endif
                <a href="{{ route('legal-pages.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow hover:bg-gray-400 transition">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</x-app-layout>