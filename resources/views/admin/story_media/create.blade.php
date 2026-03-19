<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-1">Добавить медиа</h1>
        <p class="text-sm text-gray-600 mb-6">История: {{ $story->title }}</p>

        <form action="{{ route('stories.media.store', $story) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow space-y-6">
            @csrf
            @include('admin.story_media.form', ['allowMultiple' => true])

            <div class="text-right">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
