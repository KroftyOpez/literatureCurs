<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends ApiRequest
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
            'email' => 'email|min:5|max:64|unique:users,email',
            'nickname' => 'string|min:2|max:64|unique:users,nickname',
            'avatar' => 'string|min:1|max:255',
            'birth' => 'date',
            'password' => 'string|min:8|max:64',
            'token' => 'string|max:255',
            'role_id' => 'integer|exists:roles,id',
        ];
    }
    public function messages()
    {
        return [
            'email.email' => 'Поле "Электронная почта" должно быть действительным адресом электронной почты.',
            'email.min' => 'Поле "Электронная почта" должно содержать не менее :min символов.',
            'email.max' => 'Поле "Электронная почта" должно содержать не более :max символов.',
            'email.unique' => 'Такая "Электронная почта" уже существует.',

            'nickname.max' => 'Поле "Псевдоним" должно содержать не более :max символов.',
            'nickname.min' => 'Поле "Псевдоним" должно содержать не менее :min символов.',

            'avatar.max' => 'Поле "Фамилия" должно содержать не менее :max символов.',

            'birth.date' => 'Дата рождения должна быть в формате YYYY-MM-DD',

            'password.min' => 'Поле "Пароль" должно содержать не менее :min символов.',
            'password.max' => 'Поле "Пароль" должно содержать не более :max символов.',
        ];
    }
}
