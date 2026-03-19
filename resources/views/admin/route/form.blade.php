@csrf

<div class="space-y-6">

    <!-- Title -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Название</label>
        <input type="text" name="title" value="{{ old('title', $route->title ?? '') }}" required
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">

        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Main checkbox -->
    <div class="flex items-center gap-3">
        <input type="checkbox" name="main" value="1" {{ old('main', $route->main ?? false) ? 'checked' : '' }}
            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">

        <label class="text-sm text-gray-700">Главный маршрут</label>
    </div>

    <!-- Order -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Порядок</label>
        <input type="number" name="order" value="{{ old('order', $route->order ?? 0) }}"
            class="block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-700">

        @error('order')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>
