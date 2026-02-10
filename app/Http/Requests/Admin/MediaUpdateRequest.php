<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MediaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'block_id' => ['nullable', 'integer', 'exists:blocks,id'],
            'type' => ['required', Rule::in(['image', 'video'])],
            'url' => ['required', 'string', 'max:2048'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
