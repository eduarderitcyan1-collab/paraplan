<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Редактировать точку полета</h1>

        <form action="{{ route('flyPoint.update', $flyPoint) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white shadow rounded-xl p-6">
            @method('PUT')
            @include('admin.flyPoint.form', ['flyPoint' => $flyPoint])
        </form>
    </div>
</x-app-layout>
