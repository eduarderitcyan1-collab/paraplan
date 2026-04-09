<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Редактирование баннера</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-xl p-6">

            <form action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Заголовок баннера</label>
                    <input type="text" name="title" value="{{ old('title', $banner->title ?? '') }}"
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Тип медиа</label>
                    <select name="type"
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="image" {{ old('type', $banner->type ?? '') == 'image' ? 'selected' : '' }}>
                            Изображение</option>
                        <option value="video" {{ old('type', $banner->type ?? '') == 'video' ? 'selected' : '' }}>
                            Видео</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Файл баннера</label>
                    <input type="file" name="media" class="block w-full text-gray-700 rounded-lg" />

                    @if (!empty($banner->media_path))
                        <div class="mt-4">
                            @if ($banner->type === 'image')
                                <img src="{{ Storage::url($banner->media_path) }}" alt="banner"
                                    class="w-64 rounded-lg shadow">
                            @else
                                <video src="{{ Storage::url($banner->media_path) }}" class="w-64 rounded-lg shadow"
                                    autoplay loop muted></video>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mb-6 border-t pt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Мобильный баннер (≤700px)</h2>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Файл мобильного баннера</label>
                        <input type="file" name="mobile_media_path" class="block w-full text-gray-700 rounded-lg" />
                        <p class="text-xs text-gray-500 mt-1">
                            Рекомендуемый размер для мобильного баннера — до 700px по ширине
                        </p>
                    </div>
                    @if (!empty($banner->mobile_media_path))
                        <div class="mt-4">
                            @if ($banner->type === 'image')
                                <img src="{{ Storage::url($banner->mobile_media_path) }}" alt="mobile banner"
                                    class="w-64 rounded-lg shadow">
                            @else
                                <video src="{{ Storage::url($banner->mobile_media_path) }}"
                                    class="w-64 rounded-lg shadow" autoplay loop muted></video>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                        Сохранить
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
