<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadStatusCreateRequest extends ApiRequest
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
            'status' => 'required|boolean',
            'user_id' => 'required|integer|exists:users,id',
            'history_id' => 'required|integer|exists:histories,id',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Поле "Статус" обязательно для заполнения.',
            'user_id.required' => 'Поле "Пользователь" обязательно для заполнения.',
            'history_id.required' => 'Поле "История" обязательно для заполнения.',
        ];
    }
}
