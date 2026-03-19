<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">SEO инфа на главной</h1>

        <form action="{{ route('home-seo-info.update', $homeSeoInfo) }}" method="POST"
            class="bg-white p-6 rounded-xl shadow space-y-6">
            @csrf
            @method('PUT')

            @include('admin.seo.home-info-form', ['homeSeoInfo' => $homeSeoInfo])

            <div class="text-right">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Обновить
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
