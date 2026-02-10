@include('admin.partials.layout-start')
@php($definition = $block->definition())
<h1 class="mb-4 text-2xl font-semibold">{{ $item ? 'Редактирование элемента' : 'Новый элемент' }} блока {{ $block->name }}</h1>
@if ($errors->any())<div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif

<div class="mb-4 rounded border border-indigo-200 bg-indigo-50 p-3 text-sm text-indigo-900">
    <div><b>Код блока:</b> {{ $block->code }}</div>
    @if($definition)
        <div class="mt-1"><b>Ожидаемые ключи payload:</b> {{ implode(', ', $definition['required_payload_keys'] ?? []) ?: 'нет обязательных' }}</div>
        <pre class="mt-2 overflow-x-auto rounded bg-white p-2 text-xs">{{ json_encode($definition['payload_example'] ?? [], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) }}</pre>
    @endif
</div>

<form method="POST" action="{{ $action }}" class="space-y-4 rounded bg-white p-5 shadow">
    @csrf
    @if($method !== 'POST') @method($method) @endif
    <div><label class="mb-1 block text-sm">Заголовок</label><input name="title" class="w-full rounded border-gray-300" value="{{ old('title', $item?->title ?? '') }}"></div>
    <div><label class="mb-1 block text-sm">Подзаголовок</label><input name="subtitle" class="w-full rounded border-gray-300" value="{{ old('subtitle', $item?->subtitle ?? '') }}"></div>
    <div><label class="mb-1 block text-sm">Описание</label><textarea name="description" rows="5" class="w-full rounded border-gray-300">{{ old('description', $item?->description ?? '') }}</textarea></div>
    <div><label class="mb-1 block text-sm">Payload JSON</label><textarea name="payload_json" rows="12" class="w-full rounded border-gray-300">{{ old('payload_json', json_encode($item?->payload, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)) }}</textarea></div>
    <div><label class="mb-1 block text-sm">Порядок</label><input type="number" min="0" name="display_order" class="w-full rounded border-gray-300" value="{{ old('display_order', $item?->display_order ?? 0) }}"></div>
    <button class="rounded bg-indigo-600 px-4 py-2 text-white">Сохранить</button>
</form>
@include('admin.partials.layout-end')
