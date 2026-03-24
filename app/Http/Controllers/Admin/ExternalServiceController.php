<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExternalService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExternalServiceController extends Controller
{
    public function index()
    {
        $items = ExternalService::query()->latest()->paginate(20);

        return view('admin.seo.scripts.index', compact('items'));
    }

    public function create()
    {
        return view('admin.seo.scripts.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        ExternalService::query()->create($data);

        return redirect()->route('external-services.index')->with('success', 'Скрипт добавлен.');
    }

    public function edit(ExternalService $externalService)
    {
        return view('admin.seo.scripts.edit', compact('externalService'));
    }

    public function update(Request $request, ExternalService $externalService)
    {
        $data = $this->validateData($request);

        $externalService->update($data);

        return redirect()->route('external-services.index')->with('success', 'Скрипт обновлён.');
    }

    public function destroy(ExternalService $externalService)
    {
        $externalService->delete();

        return redirect()->route('external-services.index')->with('success', 'Скрипт удалён.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'key' => ['nullable', 'string', 'max:255'],
            'token' => ['nullable', 'string', 'max:1000'],
            'script' => ['nullable', 'string'],
            'config_json' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
        ]);

        $config = null;
        $configJson = trim((string) ($validated['config_json'] ?? ''));

        if ($configJson !== '') {
            $config = json_decode($configJson, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw ValidationException::withMessages([
                    'config_json' => 'Невалидный JSON в поле "Доп. настройки".',
                ]);
            }
        }

        return [
            'name' => $validated['name'],
            'key' => $validated['key'] ?? null,
            'token' => $validated['token'] ?? null,
            'script' => $validated['script'] ?? null,
            'config' => $config,
            'active' => $request->boolean('active', false),
        ];
    }
}
