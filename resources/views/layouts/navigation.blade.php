<nav x-data="{ open: false }" class="border-b border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('welcome') }}" class="text-lg font-semibold text-indigo-700">Paraplan Анапа</a>
                @auth
                    <a href="{{ route('admin.blocks.index') }}" class="text-sm text-gray-700 hover:text-indigo-700">Админка</a>
                @endauth
            </div>

            @auth
                <div class="hidden sm:flex sm:items-center sm:gap-3">
                    <span class="text-sm text-gray-600">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                    <a href="{{ route('profile.edit') }}" class="text-sm text-gray-700 hover:text-indigo-700">Профиль</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 hover:text-red-700">Выход</button>
                    </form>
                </div>
            @endauth

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="rounded p-2 text-gray-500 hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="sm:hidden border-t border-gray-100 px-4 py-3 space-y-2">
        @auth
            <a class="block text-sm" href="{{ route('admin.blocks.index') }}">Админка</a>
            <a class="block text-sm" href="{{ route('profile.edit') }}">Профиль</a>
            <form method="POST" action="{{ route('logout') }}">@csrf <button class="block text-sm text-red-600">Выход</button></form>
        @endauth
    </div>
</nav>
