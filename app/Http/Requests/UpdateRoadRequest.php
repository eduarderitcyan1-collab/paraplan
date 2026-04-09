<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoadRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Разрешаем всем аутентифицированным пользователям
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'desc'  => 'nullable|string',
            'video' => 'nullable|file|mimes:webm|max:20480', // только webM до 20MB
            'map'   => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название обязательно для заполнения',
            'video.mimes'    => 'Видео должно быть в формате webM',
            'video.max'      => 'Размер видео не должен превышать 20 МБ',
        ];
    }
}