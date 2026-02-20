<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\About;

class UpdateAboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $about = About::first();

        return [
            'title' => 'required|string|max:255',
            'desc'  => 'required|string',

            'video' => $about && $about->video
                ? 'nullable|file|mimetypes:video/webm|max:5000'
                : 'required|file|mimetypes:video/webm|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Введите заголовок',
            'title.max'      => 'Заголовок не должен превышать 255 символов',

            'desc.required'  => 'Введите описание',

            'video.required'   => 'Загрузите видео',
            'video.mimetypes'  => 'Видео должно быть в формате webM',
            'video.max'        => 'Размер видео не должен превышать 5MB',
            'video.file'       => 'Файл загружен некорректно',
        ];
    }
}
