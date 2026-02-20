<div
    class="relative bg-white/80 backdrop-blur-lg border border-gray-200 rounded-3xl p-8 shadow-lg transition-all duration-500">

    <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-black-600 transition">
        {{ $title }}
    </h2>

    <p class="text-gray-500 mb-6 leading-relaxed">
        {{ $description }}
    </p>

    <div class="flex items-end justify-between">
        <div>
            <p class="text-gray-400 text-sm">Всего записей: <strong>{{ $count }}</strong></p>
        </div>

        <span class="text-sm font-semibold text-black-500 group-hover:translate-x-1 transition">
            Перейти →
        </span>
    </div>
</div>
