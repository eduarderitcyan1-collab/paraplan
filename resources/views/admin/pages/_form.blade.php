<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-gray-800">{{ $page ? 'Редактирование страницы' : 'Новая страница' }}</h2></x-slot>
    <div class="py-8"><div class="mx-auto max-w-3xl sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        <form method="POST" action="{{ $action }}" class="space-y-4">@csrf @if($method !== 'POST') @method($method) @endif
            <div><x-input-label for="title" value="Название" /><x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $page->title ?? '')" required/></div>
            <div><x-input-label for="slug" value="Slug" /><x-text-input id="slug" name="slug" class="mt-1 block w-full" :value="old('slug', $page->slug ?? '')" required/></div>
            <div><x-input-label for="status" value="Статус" /><select id="status" name="status" class="mt-1 block w-full rounded border-gray-300"><option>draft</option><option>published</option><option>archived</option></select></div>
            <div><x-input-label for="meta_title" value="Meta title" /><x-text-input id="meta_title" name="meta_title" class="mt-1 block w-full" :value="old('meta_title', $page->meta_title ?? '')"/></div>
            <div><x-input-label for="meta_description" value="Meta description" /><textarea id="meta_description" name="meta_description" class="mt-1 block w-full rounded border-gray-300">{{ old('meta_description', $page->meta_description ?? '') }}</textarea></div>
            <div><x-input-label for="display_order" value="Порядок" /><x-text-input type="number" id="display_order" name="display_order" class="mt-1 block w-full" :value="old('display_order', $page->display_order ?? 0)"/></div>
            <x-primary-button>Сохранить</x-primary-button>
        </form>
    </div></div></div>
</x-app-layout>
