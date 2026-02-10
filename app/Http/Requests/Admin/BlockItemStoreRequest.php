<?php

namespace App\Http\Requests\Admin;

use App\Models\Block;
use Illuminate\Foundation\Http\FormRequest;

class BlockItemStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('payload_json') && ! $this->has('payload')) {
            $data = json_decode((string) $this->input('payload_json'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->merge(['payload' => $data]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'payload' => ['nullable', 'array'],
            'payload_json' => ['nullable', 'json'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            /** @var Block|null $block */
            $block = $this->route('block');
            $definition = $block?->definition();
            $required = $definition['required_payload_keys'] ?? [];
            $payload = $this->input('payload', []);

            foreach ($required as $key) {
                if (! is_array($payload) || ! array_key_exists($key, $payload) || $payload[$key] === null || $payload[$key] === '') {
                    $validator->errors()->add('payload_json', "Для блока '{$block?->code}' обязательно поле payload.{$key}");
                }
            }
        });
    }
}
