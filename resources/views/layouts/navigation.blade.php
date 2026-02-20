<aside class="w-64 bg-white shadow-md min-h-screen fixed left-0 top-0 flex flex-col">
    <a href="{{ route('welcome') }}" class="flex justify-center px-6 py-4 border-b" style="text-align: left;">
        <img src="{{ asset('/images/logo/logo.svg') }}" alt="Logo" class="w-20 h-auto">
    </a>


    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Панель
            управления</a>
        <a href="{{ route('whyUs.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Почему
            мы?</a>
        <a href="{{ route('tarif.index') }}"
            class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Тарифы</a>
        <a href="{{ route('service.index') }}"
            class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Услуги</a>
        <a href="{{ route('team.index') }}"
            class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Команда</a>
        <a href="{{ route('sertificate.index') }}"
            class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Сертификаты</a>
        <a href="{{ route('offer.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Оффер</a>
        <a href="{{ route('review.index') }}"
            class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Отзывы</a>
        <a href="{{ route('about.edit') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">О нас</a>
        <a href="{{ route('flyPoint.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">Точки
            полетов</a>
    </nav>

    @auth
        <div class="px-4 py-4 border-t">
            <span class="block text-sm text-gray-600 mb-2">{{ auth()->user()->name }}</span>
            <a href="{{ route('profile.edit') }}"
                class="block text-sm text-gray-700 hover:text-indigo-700 mb-2">Профиль</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block text-sm text-red-600 hover:text-red-700">Выход</button>
            </form>
        </div>
    @endauth
</aside>
