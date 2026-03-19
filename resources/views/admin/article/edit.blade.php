<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Редактировать статью</h1>

        <form action="{{ route('articles.update', $article) }}" method="POST"
            class="bg-white p-6 rounded-xl shadow space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.article.form', ['article' => $article])

            <div class="text-right">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Обновить
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
