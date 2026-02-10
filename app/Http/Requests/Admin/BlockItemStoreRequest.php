<?php

namespace App\Http\Requests\Admin;

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
}
