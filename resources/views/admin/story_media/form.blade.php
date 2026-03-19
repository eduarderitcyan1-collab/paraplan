@if ($errors->any())
    <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
        <ul class="list-disc ml-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $currentMedia = $medium ?? null;
    $allowMultiple = $allowMultiple ?? false;
@endphp

<div class="space-y-6">
    <div>
        <p class="text-sm text-gray-600">
            Загрузите <strong>WebP (≤2 МБ)</strong> для фото или <strong>WebM (≤8 МБ)</strong> для видео.
            Тип определяется автоматически.
        </p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Файл</label>
        <input type="file" name="{{ $allowMultiple ? 'file[]' : 'file' }}" accept="image/webp,video/webm" {{ $allowMultiple ? 'multiple' : '' }} class="w-full border border-gray-300 rounded-lg p-2">

        @if (!empty($currentMedia?->path))
            <div class="mt-3">
                @if ($currentMedia->type === 'photo')
                    <img src="{{ asset('storage/' . $currentMedia->path) }}" alt="photo" class="w-32 h-32 object-cover rounded-lg">
                @else
                    <video class="h-32 w-56 rounded-md" controls muted>
                        <source src="{{ asset('storage/' . $currentMedia->path) }}">
                        Ваш браузер не поддерживает видео.
                    </video>
                @endif
            </div>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Сортировка</label>
        <input type="number" name="sort" min="0" value="{{ old('sort', $currentMedia->sort ?? '') }}"
            class="w-full border border-gray-300 rounded-lg p-2">
        <p class="text-xs text-gray-500 mt-1">Оставьте пустым, чтобы авто-подставить следующий номер.</p>
    </div>
</div>
