<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6 space-y-6">
        <div class="flex justify-between items-center gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-gray-800">Редактор robots.txt</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('seo-pages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-sm rounded">Назад</a>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('seo-pages.robots.update') }}" method="POST">
                @csrf
                @method('PUT')

                <p class="text-sm text-gray-600 mb-2">Содержимое файла <strong>robots.txt</strong>. Админ может редактировать произвольно. Также доступны быстрые кнопки:</p>

                <textarea name="robots" rows="12" class="w-full border rounded p-2 text-sm font-mono">{{ old('robots', $content) }}</textarea>

                <div class="mt-4 flex items-center gap-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700">Сохранить</button>
                    <button type="submit" name="mode" value="open" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">Открыть (разрешить, кроме админки)</button>
                    <button type="submit" name="mode" value="close" class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700">Закрыть (запретить всё)</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
