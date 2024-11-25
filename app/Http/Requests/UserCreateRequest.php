<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends ApiRequest
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
            'email' => 'required|email|min:5|max:64|unique:users,email',
            'nickname' => 'required|string|min:2|max:64|unique:users,nickname',
            'avatar' => 'nullable|string|min:1|max:255',
            'birth' => 'required|date',
            'password' => 'required|string|min:8|max:64',
            'token' => 'nullable|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Поле "Электронная почта" обязательно для заполнения.',
            'email.email' => 'Поле "Электронная почта" должно быть действительным адресом электронной почты.',
            'email.min' => 'Поле "Электронная почта" должно содержать не менее :min символов.',
            'email.max' => 'Поле "Электронная почта" должно содержать не более :max символов.',
            'email.unique' => 'Такая "Электронная почта" уже существует.',

            'nickname.required' => 'Поле "Псевдоним" обязательно для заполнения.',
            'nickname.max' => 'Поле "Псевдоним" должно содержать не более :max символов.',
            'nickname.min' => 'Поле "Псевдоним" должно содержать не менее :min символов.',

            'avatar.max' => 'Поле "Фамилия" должно содержать не менее :max символов.',

            'birth.date' => 'Дата рождения должна быть в формате YYYY-MM-DD',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.min' => 'Поле "Пароль" должно содержать не менее :min символов.',
            'password.max' => 'Поле "Пароль" должно содержать не более :max символов.',

            'role_id.required' => 'Поле "Роль" обязательно для заполнения.',
        ];
    }
}
