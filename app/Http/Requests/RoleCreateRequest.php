<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleCreateRequest extends ApiRequest
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
            'name' => 'required|string|min:4|max:32',
            'code' => 'required|string|min:4|max:32',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'code.required' => 'Поле "Код" обязательно для заполнения.',
            'name.min' => 'Поле "Код" должно содержать не менее :min символов.',
            'code.min' => 'Поле "Код" должно содержать не менее :min символов.',
            'name.max' => 'Поле "Код" должно содержать не более :max символов.',
            'code.max' => 'Поле "Код" должно содержать не более :max символов.',
        ];
    }
}

