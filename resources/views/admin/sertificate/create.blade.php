<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Создать запись</h1>

        <form action="{{ route('sertificate.store') }}" method="POST" class="space-y-6 bg-white shadow rounded-xl p-6"
            enctype="multipart/form-data">
            @csrf

            @include('admin.sertificate.form')
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
