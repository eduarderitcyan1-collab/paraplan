@include('admin.partials.layout-start')
<h1 class="mb-4 text-2xl font-semibold">{{ $block ? 'Редактирование блока' : 'Создание блока' }}</h1>
@if ($errors->any())<div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ $action }}" class="space-y-4 rounded bg-white p-5 shadow">
    @csrf
    @if($method !== 'POST') @method($method) @endif
    <div><label class="mb-1 block text-sm">Название блока</label><input name="name" class="w-full rounded border-gray-300" value="{{ old('name', $block->name ?? '') }}" required></div>
    <div><label class="mb-1 block text-sm">Код блока (например: fly_points, reviews, services, tarifs, team, why_us, articles, article_page, route_categories, route_page)</label><input name="code" class="w-full rounded border-gray-300" value="{{ old('code', $block->code ?? '') }}" required></div>
    <div><label class="mb-1 block text-sm">Схема полей (JSON, необязательно)</label><textarea name="schema_json" rows="8" class="w-full rounded border-gray-300">{{ old('schema_json', json_encode($block->schema, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)) }}</textarea></div>
    <div><label class="mb-1 block text-sm">Порядок</label><input type="number" min="0" name="display_order" class="w-full rounded border-gray-300" value="{{ old('display_order', $block->display_order ?? 0) }}"></div>
    <label class="inline-flex items-center gap-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $block->is_active ?? true))> <span>Активен</span></label>
    <button class="rounded bg-indigo-600 px-4 py-2 text-white">Сохранить</button>
</form>
@include('admin.partials.layout-end')
