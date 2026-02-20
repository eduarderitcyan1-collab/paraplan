<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Раздел "О нас"</h1>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white shadow rounded-xl p-6">
            @csrf
            @method('PUT')

            @include('admin.about.form')

        </form>
    </div>
</x-app-layout>
