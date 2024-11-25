<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryUpdateRequest extends ApiRequest
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
            'content' => 'text',
            'read_time' => 'integer',
            'confirmation' => 'boolean',
            'name' => 'string|min:1|max:64',
            'description' => 'text',
            'photo' => 'string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'Поле "Название" должно содержать не более :max символов.',
            'name.min' => 'Поле "Название" должно содержать не менее :min символов.',

            'photo.max' => 'Поле "Фото" должно содержать не более :max символов.',
        ];
    }
}
