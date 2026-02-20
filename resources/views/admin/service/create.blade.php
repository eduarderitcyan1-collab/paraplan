<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold mb-6">Создать услугу</h1>

        <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow space-y-6">
            @csrf

            @include('admin.service.form')

            <div class="text-right">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Сохранить
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
