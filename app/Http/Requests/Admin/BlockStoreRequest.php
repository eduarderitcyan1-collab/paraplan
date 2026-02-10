<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlockStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('schema_json') && ! $this->has('schema')) {
            $data = json_decode((string) $this->input('schema_json'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->merge(['schema' => $data]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:blocks,code'],
            'schema' => ['nullable', 'array'],
            'schema_json' => ['nullable', 'json'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
