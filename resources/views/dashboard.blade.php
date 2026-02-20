<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Панель управления
            </h1>
            <p class="text-gray-500 mt-2">
                Управляйте контентом сайта и отслеживайте основные показатели.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            <!-- WHY US -->
            <a href="{{ route('whyUs.index') }}" class="flex flex-col group dashboard-card">
                @include('components.dashboard-card', [
                    'title' => 'Почему мы',
                    'description' => 'Преимущества компании.',
                    'count' => $whyUsCount ?? 0,
                ])
            </a>

            <!-- TARIF -->
            <a href="{{ route('tarif.index') }}" class="flex flex-col group dashboard-card">
                @include('components.dashboard-card', [
                    'title' => 'Тарифы',
                    'description' => 'Настройка тарифных планов.',
                    'count' => $tarifCount ?? 0,
                ])
            </a>

            <!-- SERVICE -->
            <a href="{{ route('service.index') }}" class="flex flex-col group dashboard-card">
                @include('components.dashboard-card', [
                    'title' => 'Услуги',
                    'description' => 'Редактирование списка услуг.',
                    'count' => $serviceCount ?? 0,
                ])
            </a>

            <!-- TEAM -->
            <a href="{{ route('team.index') }}" class="flex flex-col group dashboard-card">
                @include('components.dashboard-card', [
                    'title' => 'Команда',
                    'description' => 'Управление участниками команды.',
                    'count' => $teamCount ?? 0,
                ])
            </a>

            <!-- SERTIFICATE -->
            <a href="{{ route('sertificate.index') }}" class="flex flex-col group dashboard-card">
                @include('components.dashboard-card', [
                    'title' => 'Сертификаты',
                    'description' => 'Управление сертификатами.',
                    'count' => $sertificateCount ?? 0,
                ])
            </a>

            <!-- OFFER -->
            <a href="{{ route('offer.index') }}" class="flex flex-col group dashboard-card">
                @include('components.dashboard-card', [
                    'title' => 'Предложения',
                    'description' => 'Создание и управление предложениями.',
                    'count' => $offerCount ?? 0,
                ])
            </a>

            <!-- REVIEW -->
            <a href="{{ route('review.index') }}" class="flex flex-col group dashboard-card">
                @include('components.dashboard-card', [
                    'title' => 'Отзывы',
                    'description' => 'Модерация отзывов клиентов.',
                    'count' => $reviewCount ?? 0,
                ])
            </a>

        </div>
    </div>
</x-app-layout>
