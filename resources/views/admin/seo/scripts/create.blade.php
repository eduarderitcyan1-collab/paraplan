<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6 space-y-6">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h1 class="text-2xl font-bold text-gray-800">Добавить скрипт</h1>
            <a href="{{ route('external-services.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-sm font-medium rounded-lg hover:bg-gray-300 transition">Назад</a>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('external-services.store') }}" method="POST" class="space-y-4">
                @csrf
                @include('admin.seo.scripts.form')

                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">Сохранить</button>
            </form>
        </div>
    </div>
</x-app-layout>
