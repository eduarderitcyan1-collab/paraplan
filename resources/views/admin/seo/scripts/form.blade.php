<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Название</label>
        <input type="text" name="name" value="{{ old('name', $externalService->name ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2 text-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Ключ (опционально)</label>
        <input type="text" name="key" value="{{ old('key', $externalService->key ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2 text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Токен (опционально)</label>
        <input type="text" name="token" value="{{ old('token', $externalService->token ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2 text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Скрипт (JS/HTML)</label>
        <textarea name="script" rows="10" class="w-full border border-gray-300 rounded-lg p-2 text-sm font-mono">{{ old('script', $externalService->script ?? '') }}</textarea>
        <p class="text-xs text-gray-500 mt-1">Код вставляется на все страницы сайта для активных записей.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Доп. настройки (JSON)</label>
        <textarea name="config_json" rows="5" class="w-full border border-gray-300 rounded-lg p-2 text-sm font-mono">{{ old('config_json', isset($externalService) && $externalService->config ? json_encode($externalService->config, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>

    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
        <input type="checkbox" name="active" value="1" {{ old('active', isset($externalService) ? $externalService->active : true) ? 'checked' : '' }}>
        Активно
    </label>
</div>
