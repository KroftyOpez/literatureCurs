<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeCreateRequest extends ApiRequest
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
            'comment' => 'required|text',
            'grade' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id',
            'history_id' => 'required|integer|exists:history,id',
        ];
    }
    public function messages()
    {
        return [
            'comment.required' => 'Поле "Комментарий" обязательно для заполнения.',
            'grade.required' => 'Поле "Оценка" обязательно для заполнения.',
            'user_id.required' => 'Поле "Пользователь" обязательно для заполнения.',
            'history_id.required' => 'Поле "История" обязательно для заполнения.',
        ];
    }
}

