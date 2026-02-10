@include('admin.partials.layout-start')
<h1 class="mb-4 text-2xl font-semibold">{{ $galleryItem ? 'Редактирование' : 'Добавление' }} элемента галереи</h1>
@if ($errors->any())<div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ $action }}" class="space-y-4 rounded bg-white p-5 shadow">
    @csrf
    @if($method !== 'POST') @method($method) @endif
    <div><label class="mb-1 block text-sm">Тип</label><select name="type" class="w-full rounded border-gray-300"><option value="photo" @selected(old('type', $galleryItem->type ?? '') === 'photo')>photo</option><option value="video" @selected(old('type', $galleryItem->type ?? '') === 'video')>video</option></select></div>
    <div><label class="mb-1 block text-sm">URL</label><input name="url" class="w-full rounded border-gray-300" value="{{ old('url', $galleryItem->url ?? '') }}" required></div>
    <div><label class="mb-1 block text-sm">Preview URL (для видео)</label><input name="preview_url" class="w-full rounded border-gray-300" value="{{ old('preview_url', $galleryItem->preview_url ?? '') }}"></div>
    <div><label class="mb-1 block text-sm">Название</label><input name="title" class="w-full rounded border-gray-300" value="{{ old('title', $galleryItem->title ?? '') }}"></div>
    <div><label class="mb-1 block text-sm">Порядок</label><input type="number" min="0" name="display_order" class="w-full rounded border-gray-300" value="{{ old('display_order', $galleryItem->display_order ?? 0) }}"></div>
    <button class="rounded bg-indigo-600 px-4 py-2 text-white">Сохранить</button>
</form>
@include('admin.partials.layout-end')
