@include('admin.partials.layout-start')
<h1 class="mb-4 text-2xl font-semibold">{{ $block ? 'Редактирование блока' : 'Создание блока' }}</h1>
@if ($errors->any())<div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ $action }}" class="space-y-4 rounded bg-white p-5 shadow">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div>
        <label class="mb-1 block text-sm">Тип контента</label>
        <select id="code" name="code" class="w-full rounded border-gray-300" required>
            <option value="">Выберите тип</option>
            @foreach($definitions as $key => $meta)
                <option value="{{ $key }}" data-title="{{ $meta['title'] }}" data-example='@json($meta['payload_example'])' @selected(old('code', $block->code ?? '') === $key)>
                    {{ $meta['title'] }} ({{ $key }})
                </option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-gray-500">Вы используете фиксированный список блоков под шаблоны фронтенда.</p>
    </div>

    <div>
        <label class="mb-1 block text-sm">Название блока</label>
        <input id="name" name="name" class="w-full rounded border-gray-300" value="{{ old('name', $block->name ?? '') }}" required>
    </div>

    <div>
        <label class="mb-1 block text-sm">Схема полей (JSON, необязательно)</label>
        <textarea id="schema_json" name="schema_json" rows="8" class="w-full rounded border-gray-300">{{ old('schema_json', json_encode($block->schema, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)) }}</textarea>
    </div>

    <div><label class="mb-1 block text-sm">Порядок</label><input type="number" min="0" name="display_order" class="w-full rounded border-gray-300" value="{{ old('display_order', $block->display_order ?? 0) }}"></div>
    <label class="inline-flex items-center gap-2"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $block->is_active ?? true))> <span>Активен</span></label>
    <button class="rounded bg-indigo-600 px-4 py-2 text-white">Сохранить</button>
</form>

<script>
const code = document.getElementById('code');
const name = document.getElementById('name');
code.addEventListener('change', () => {
    const selected = code.options[code.selectedIndex];
    if (!name.value && selected.dataset.title) {
        name.value = selected.dataset.title;
    }
});
</script>
@include('admin.partials.layout-end')
