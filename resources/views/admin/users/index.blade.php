<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold">Пользователи</h2></x-slot>
    <div class="py-8"><div class="mx-auto max-w-5xl sm:px-6 lg:px-8">@include('admin.partials.flash')
        <table class="min-w-full bg-white shadow"><thead><tr><th class="p-2">Имя</th><th>Email</th><th>Роль</th><th></th></tr></thead><tbody>
        @foreach($users as $user)
            <tr class="border-t"><td class="p-2">{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td><td><a class="text-yellow-600" href="{{ route('admin.users.edit',$user) }}">Изменить</a></td></tr>
        @endforeach
        </tbody></table><div class="mt-4">{{ $users->links() }}</div>
    </div></div>
</x-app-layout>
