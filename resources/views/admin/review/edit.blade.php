<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Редактировать отзыв</h1>

        <form action="{{ route('review.update', $review) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white shadow rounded-xl p-6">
            @csrf
            @method('PUT')

            @include('admin.review.form', ['review' => $review])

        </form>
    </div>
</x-app-layout>
