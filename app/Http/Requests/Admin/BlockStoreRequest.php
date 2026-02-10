<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlockStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(['text', 'image', 'video', 'gallery', 'button'])],
            'content' => ['required', 'array'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
