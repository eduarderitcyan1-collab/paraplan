@include('admin.partials.layout-start')
<h1 class="mb-4 text-2xl font-semibold">Изменение роли: {{ $user->name }}</h1>
<form method="POST" action="{{ route('admin.users.update', $user) }}" class="max-w-xl space-y-4 rounded bg-white p-5 shadow">
    @csrf
    @method('PUT')
    <div><label class="mb-1 block text-sm">Роль</label><select name="role" class="w-full rounded border-gray-300"><option value="admin" @selected($user->role === 'admin')>admin</option><option value="editor" @selected($user->role === 'editor')>editor</option></select></div>
    <button class="rounded bg-indigo-600 px-4 py-2 text-white">Сохранить</button>
</form>
@include('admin.partials.layout-end')
