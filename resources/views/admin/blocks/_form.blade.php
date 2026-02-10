<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-gray-800">{{ $block ? 'Редактирование блока' : 'Новый блок' }}</h2></x-slot>
    <div class="py-8"><div class="mx-auto max-w-3xl sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        <form method="POST" action="{{ $action }}" class="space-y-4">@csrf @if($method !== 'POST') @method($method) @endif
            <div><x-input-label for="type" value="Тип" /><select name="type" id="type" class="mt-1 block w-full rounded border-gray-300">@foreach(['text','image','video','gallery','button'] as $type)<option value="{{ $type }}" @selected(old('type', $block->type ?? '')===$type)>{{ $type }}</option>@endforeach</select></div>
            <div><x-input-label for="content_json" value="Content (JSON)" /><textarea id="content_json" class="mt-1 block w-full rounded border-gray-300" rows="8">{{ old('content_json', json_encode($block->content ?? ['text'=>''], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)) }}</textarea><input type="hidden" id="content" name="content"></div>
            <div><x-input-label for="display_order" value="Порядок" /><x-text-input type="number" id="display_order" name="display_order" class="mt-1 block w-full" :value="old('display_order', $block->display_order ?? 0)"/></div>
            <x-primary-button onclick="syncJson(event)">Сохранить</x-primary-button>
        </form>
    </div></div></div>
    <script>
        function syncJson(e){
            try {
                const parsed = JSON.parse(document.getElementById('content_json').value);
                const hidden = document.getElementById('content');
                hidden.value = '';
                Object.entries(parsed).forEach(([key,val]) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `content[${key}]`;
                    input.value = typeof val === 'object' ? JSON.stringify(val) : val;
                    e.target.form.appendChild(input);
                });
            } catch (err) {
                e.preventDefault();
                alert('Некорректный JSON');
            }
        }
    </script>
</x-app-layout>
