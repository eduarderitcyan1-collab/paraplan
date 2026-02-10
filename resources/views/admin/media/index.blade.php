<x-app-layout>
    <x-slot name="header"><div class="flex justify-between"><h2 class="text-xl font-semibold">Медиа</h2><a href="{{ route('admin.media.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">Добавить</a></div></x-slot>
    <div class="py-8"><div class="mx-auto max-w-6xl sm:px-6 lg:px-8">@include('admin.partials.flash')
        <table class="min-w-full bg-white shadow"><thead><tr><th class="p-2">ID</th><th>Тип</th><th>URL</th><th>Блок</th><th></th></tr></thead><tbody>
            @foreach($media as $item)
                <tr class="border-t"><td class="p-2">{{ $item->id }}</td><td>{{ $item->type }}</td><td class="max-w-md truncate">{{ $item->url }}</td><td>{{ $item->block_id }}</td><td><a class="text-yellow-600" href="{{ route('admin.media.edit',$item) }}">Ред.</a> <form method="POST" class="inline" action="{{ route('admin.media.destroy',$item) }}">@csrf @method('DELETE')<button class="text-red-600">Удалить</button></form></td></tr>
            @endforeach
        </tbody></table>
        <div class="mt-4">{{ $media->links() }}</div>
    </div></div>
</x-app-layout>
