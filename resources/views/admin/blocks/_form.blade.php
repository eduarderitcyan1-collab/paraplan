<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $block ? 'Редактирование блока' : 'Новый блок' }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-800">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="POST" action="{{ $action }}" class="space-y-4">
                    @csrf
                    @if($method !== 'POST')
                        @method($method)
                    @endif

                    <div>
                        <x-input-label for="type" value="Тип" />
                        <select name="type" id="type" class="mt-1 block w-full rounded border-gray-300">
                            @foreach($blockTypes as $type)
                                <option value="{{ $type }}" @selected(old('type', $block->type ?? '') === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="content_json" value="Content (JSON)" />
                        <textarea id="content_json" name="content_json" class="mt-1 block w-full rounded border-gray-300" rows="12" required>{{ old('content_json', json_encode($block->content ?? ['text' => ''], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="display_order" value="Порядок" />
                        <x-text-input type="number" id="display_order" name="display_order" class="mt-1 block w-full" :value="old('display_order', $block->display_order ?? 0)" min="0" />
                    </div>

                    <x-primary-button>Сохранить</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
