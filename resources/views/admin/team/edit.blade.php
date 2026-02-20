<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold mb-6">Редактировать участника</h1>

        @include('admin.team.form', [
            'route' => route('team.update', $team),
            'method' => 'PUT',
            'team' => $team,
        ])

    </div>
</x-app-layout>
