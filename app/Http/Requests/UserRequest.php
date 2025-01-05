<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        // STORE
        if ($this->method() == 'POST') {
            return [
                'name'                  => 'required',
                'email'                 => 'required|email|unique:users',
                'username'              => 'required|unique:users',
                'password'              => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ];
        }
        // UPDATE
        if ($this->method() == 'PUT') {
            return [
                'name'                  => 'required',
                'password'              => 'nullable|min:6',
                'password_confirmation' => 'nullable|same:password',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required'                     => 'Nome é obrigatório.',
            'email.required'                    => 'Email é obrigatório.',
            'username.required'                 => 'Nome de usuário é obrigatório.',
            'username.unique'                   => 'Nome de usuário já existe.',
            'email.email'                       => 'Email não é válido.',
            'email.unique'                      => 'Email já existe.',
            'password.required'                 => 'Senha é obrigatória.',
            'password_confirmation.required'    => 'Confirmar Senha é obrigatória.',
            'password_confirmation.same'        => 'Senha e confirmar senha precisam ser iguais.',
        ];
    }
}
