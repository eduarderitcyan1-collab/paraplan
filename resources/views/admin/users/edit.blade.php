<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold">Роль пользователя: {{ $user->name }}</h2></x-slot>
    <div class="py-8"><div class="mx-auto max-w-xl sm:px-6 lg:px-8"><div class="bg-white p-6 shadow sm:rounded-lg">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">@csrf @method('PUT')
            <div><x-input-label for="role" value="Роль" /><select id="role" name="role" class="mt-1 block w-full rounded border-gray-300"><option value="admin" @selected($user->role==='admin')>admin</option><option value="editor" @selected($user->role==='editor')>editor</option></select></div>
            <x-primary-button>Сохранить</x-primary-button>
        </form>
    </div></div></div>
</x-app-layout>
