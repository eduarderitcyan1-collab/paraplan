<?php

namespace App\Http\Requests\Admin;

use App\Models\Block;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlockUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('content_json') && ! $this->has('content')) {
            $decoded = json_decode((string) $this->input('content_json'), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $this->merge(['content' => $decoded]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(Block::allowedTypes())],
            'content' => ['required', 'array'],
            'content_json' => ['nullable', 'json'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
