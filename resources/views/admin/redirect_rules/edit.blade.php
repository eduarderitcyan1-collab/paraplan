<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Редактировать редирект #{{ $redirectRule->id }}
            </h1>

            <a href="{{ route('redirect-rules.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
                Назад
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

        {{-- Form --}}
        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('redirect-rules.update', $redirectRule) }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                @csrf
                @method('PATCH')

                {{-- from_url --}}
                <div class="md:col-span-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        С какого URL
                    </label>
                    <input type="text" name="from_url" value="{{ old('from_url', $redirectRule->from_url) }}"
                        placeholder="/staryy-url" required
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- to_url --}}
                <div class="md:col-span-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        На какой URL
                    </label>
                    <input type="text" name="to_url" value="{{ old('to_url', $redirectRule->to_url) }}"
                        placeholder="/novyy-url или https://example.com" required
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- status --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Код
                    </label>
                    <select name="status_code" required
                        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="301"
                            {{ (string) old('status_code', $redirectRule->status_code) === '301' ? 'selected' : '' }}>
                            301
                        </option>
                        <option value="302"
                            {{ (string) old('status_code', $redirectRule->status_code) === '302' ? 'selected' : '' }}>
                            302
                        </option>
                    </select>
                </div>

                {{-- active --}}
                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $redirectRule->is_active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

                    <span class="text-sm text-gray-700">Вкл</span>
                </div>

                {{-- submit --}}
                <div class="md:col-span-2">
                    <button
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                        Сохранить
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>
