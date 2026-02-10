<x-app-layout>
    <div class="min-h-[calc(100dvh-4rem)] bg-slate-100">
        {{--
            Фиксированный сайдбар:
            - приклеен к левому краю
            - на всю высоту viewport минус высота верхней навигации (4rem)
            - не прокручивается вместе со страницей
        --}}
        <aside class="fixed left-0 top-16 z-40 hidden h-[calc(100dvh-4rem)] w-72 overflow-y-auto border-r border-slate-800 bg-slate-900 p-4 text-slate-100 lg:block">
            <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-300">Управление контентом</h3>
            <nav class="space-y-1 text-sm">
                <a href="{{ route('admin.blocks.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.blocks.*') ? 'bg-slate-800' : '' }}">Блоки сайта</a>
                <a href="{{ route('admin.gallery-items.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.gallery-items.*') ? 'bg-slate-800' : '' }}">Галерея</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.users.*') ? 'bg-slate-800' : '' }}">Пользователи</a>
                @endif
            </nav>
        </aside>

        {{--
            Контентная область:
            - на desktop имеет отступ слева под fixed sidebar
            - начинается сверху (не уезжает вниз)
            - занимает всю доступную высоту
        --}}
        <div class="min-h-[calc(100dvh-4rem)] lg:pl-72">
            <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{-- Мобильная навигация админки (вместо fixed sidebar) --}}
                <div class="mb-4 rounded-lg bg-white p-3 shadow lg:hidden">
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                        <a href="{{ route('admin.blocks.index') }}" class="rounded px-3 py-2 text-sm {{ request()->routeIs('admin.blocks.*') ? 'bg-indigo-100 text-indigo-800' : 'bg-slate-100 text-slate-700' }}">Блоки</a>
                        <a href="{{ route('admin.gallery-items.index') }}" class="rounded px-3 py-2 text-sm {{ request()->routeIs('admin.gallery-items.*') ? 'bg-indigo-100 text-indigo-800' : 'bg-slate-100 text-slate-700' }}">Галерея</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.users.index') }}" class="rounded px-3 py-2 text-sm {{ request()->routeIs('admin.users.*') ? 'bg-indigo-100 text-indigo-800' : 'bg-slate-100 text-slate-700' }}">Пользователи</a>
                        @endif
                    </div>
                </div>
