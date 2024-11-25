<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryCreateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|text',
            'read_time' => 'required|integer',
            'confirmation' => 'required|boolean',
            'name' => 'required|string|min:1|max:64',
            'description' => 'required|text',
            'photo' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'content.required' => 'Поле "Контент" обязательно для заполнения.',
            'read_time.required' => 'Поле "Время прочтения" обязательно для заполнения.',
            'confirmation.required' => 'Поле "Подтверждение" обязательно для заполнения.',
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'description.required' => 'Поле "Описание" обязательно для заполнения.',
            'photo.required' => 'Поле "Фотография" обязательно для заполнения.',

            'name.max' => 'Поле "Название" должно содержать не более :max символов.',
            'name.min' => 'Поле "Название" должно содержать не менее :min символов.',
            'photo.max' => 'Поле "Фото" должно содержать не более :max символов.',
        ];
    }
}

