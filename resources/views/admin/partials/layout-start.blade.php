<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[240px_1fr]">
                <aside class="rounded-xl bg-slate-900 p-4 text-slate-100 shadow">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-300">Управление контентом</h3>
                    <nav class="space-y-1 text-sm">
                        <a href="{{ route('admin.blocks.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.blocks.*') ? 'bg-slate-800' : '' }}">Блоки сайта</a>
                        <a href="{{ route('admin.gallery-items.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.gallery-items.*') ? 'bg-slate-800' : '' }}">Галерея</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.users.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.users.*') ? 'bg-slate-800' : '' }}">Пользователи</a>
                        @endif
                    </nav>
                </aside>
                <section>
