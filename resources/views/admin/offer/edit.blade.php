<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Редактировать предложение</h1>

        <form action="{{ route('offer.update', ['offer' => $offer->id]) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white shadow rounded-xl p-6">

            @csrf
            @method('PUT')

            @include('admin.offer.form', ['offer' => $offer])

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition">
                    Обновить
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
