<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">{{ $mediaItem ? 'Редактирование медиа' : 'Новое медиа' }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
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
                        <select id="type" name="type" class="mt-1 block w-full rounded border-gray-300">
                            <option value="image" @selected(old('type', $mediaItem->type ?? '') === 'image')>image</option>
                            <option value="video" @selected(old('type', $mediaItem->type ?? '') === 'video')>video</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="url" value="URL" />
                        <x-text-input id="url" name="url" class="mt-1 block w-full" :value="old('url', $mediaItem->url ?? '')" required />
                    </div>

                    <div>
                        <x-input-label for="alt_text" value="Alt text" />
                        <x-text-input id="alt_text" name="alt_text" class="mt-1 block w-full" :value="old('alt_text', $mediaItem->alt_text ?? '')" />
                    </div>

                    <div>
                        <x-input-label for="display_order" value="Порядок" />
                        <x-text-input id="display_order" type="number" name="display_order" class="mt-1 block w-full" :value="old('display_order', $mediaItem->display_order ?? 0)" min="0" />
                    </div>

                    <div>
                        <x-input-label for="block_id" value="Блок" />
                        <select id="block_id" name="block_id" class="mt-1 block w-full rounded border-gray-300">
                            <option value="">—</option>
                            @foreach($blocks as $block)
                                <option value="{{ $block->id }}" @selected((string) old('block_id', $mediaItem->block_id ?? '') === (string) $block->id)>
                                    #{{ $block->id }} — {{ $block->type }} / {{ $block->page->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <x-primary-button>Сохранить</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
