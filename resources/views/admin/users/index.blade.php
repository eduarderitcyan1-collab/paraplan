@include('admin.partials.layout-start')
<h1 class="mb-4 text-2xl font-semibold">Пользователи</h1>
@include('admin.partials.flash')
<div class="overflow-hidden rounded bg-white shadow">
<table class="min-w-full text-sm"><thead class="bg-gray-50"><tr><th class="p-3 text-left">Имя</th><th>Email</th><th>Роль</th><th></th></tr></thead><tbody>
@foreach($users as $user)
<tr class="border-t"><td class="p-3">{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td><td><a class="text-amber-600" href="{{ route('admin.users.edit', $user) }}">Изменить роль</a></td></tr>
@endforeach
</tbody></table>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@include('admin.partials.layout-end')
