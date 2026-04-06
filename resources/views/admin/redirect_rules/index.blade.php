<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Редиректы</h1>

            <a href="{{ route('seo-pages.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
                Назад к SEO
            </a>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Create form --}}
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Добавить редирект</h2>

            <form action="{{ route('redirect-rules.store') }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                @csrf

                {{-- from_url --}}
                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">С какого URL</label>
                    <input type="text" name="from_url" value="{{ old('from_url') }}" placeholder="/staryy-url"
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- to_url --}}
                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">На какой URL</label>
                    <input type="text" name="to_url" value="{{ old('to_url') }}"
                        placeholder="/novyy-url или https://example.com"
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- status --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Код</label>
                    <select name="status_code"
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="301" {{ old('status_code', '301') == '301' ? 'selected' : '' }}>301</option>
                        <option value="302" {{ old('status_code') == '302' ? 'selected' : '' }}>302</option>
                    </select>
                </div>

                {{-- active --}}
                <div class="md:col-span-1 flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="text-sm text-gray-700">Вкл</span>
                </div>

                {{-- submit --}}
                <div class="md:col-span-1">
                    <button
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                        Добавить
                    </button>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Откуда</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Куда</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Код</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Активен</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($redirectRules as $rule)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <code>{{ $rule->from_url }}</code>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <code>{{ $rule->to_url }}</code>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $rule->status_code }}
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    @if ($rule->is_active)
                                        <span class="text-green-600 font-medium">Да</span>
                                    @else
                                        <span class="text-gray-400">Нет</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('redirect-rules.edit', $rule) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white text-xs font-semibold rounded-md hover:bg-yellow-500 transition">
                                        Редактировать
                                    </a>

                                    <form action="{{ route('redirect-rules.destroy', $rule) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Удалить редирект {{ $rule->from_url }}?')"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-md hover:bg-red-700 transition">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                    Пока нет редиректов
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-app-layout>
