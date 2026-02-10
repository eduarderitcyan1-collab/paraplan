@include('admin.partials.layout-start')
<h1 class="mb-4 text-2xl font-semibold">{{ $block->name }}</h1>
<div class="rounded bg-white p-5 shadow">
    <p><b>Код:</b> {{ $block->code }}</p>
    <p><b>Элементов:</b> {{ $block->items->count() }}</p>
    <pre class="mt-3 overflow-x-auto rounded bg-gray-100 p-3 text-xs">{{ json_encode($block->schema, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) }}</pre>
</div>
@include('admin.partials.layout-end')
