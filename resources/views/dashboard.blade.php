<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Панель управления') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <aside class="md:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Меню') }}</h3>

                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('admin.services.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Услуги') }}</a></li>
                            <li><a href="{{ route('admin.routes.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Маршруты') }}</a></li>
                            <li><a href="{{ route('admin.tariffs.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Тарифы') }}</a></li>
                            <li><a href="{{ route('admin.articles.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Статьи') }}</a></li>
                            <li><a href="{{ route('admin.gallery-images.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Галерея') }}</a></li>
                            <li><a href="{{ route('admin.team-members.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Команда') }}</a></li>
                            <li><a href="{{ route('admin.reviews.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Отзывы') }}</a></li>
                            <li><a href="{{ route('admin.fly-points.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Точки полётов') }}</a></li>
                            <li><a href="{{ route('admin.start-points.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Стартовые точки') }}</a></li>
                            <li><a href="{{ route('admin.certificates.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Сертификаты') }}</a></li>
                            <li><a href="{{ route('admin.pages.index') }}" class="text-blue-600 hover:text-blue-800">{{ __('Страницы') }}</a></li>
                        </ul>
                    </div>
                </aside>

                <div class="md:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __('Вы вошли в систему и можете управлять содержимым сайта через меню слева.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
