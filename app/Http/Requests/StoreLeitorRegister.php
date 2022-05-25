<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeitorRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'string|max:255|min:3',
            'CPF' =>  [
                'unique:users',
                'string',
            ],
            'email' => [
                'email',
                'unique:users',
            ],
            'password' => [
                'min:6',
            ],
            'endereco' => 'string|max:255',
            'cidade' => 'string|max:255',
            'estado' => 'string|max:2',
            'cep' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return[
            'unique' => ':attribute já cadastrado!',
            'min' => 'Campo :attribute deve ter no mínimo :min caracteres',
            'max' => 'Campo :attribute deve ter no mínimo :max caracteres',
        ];
    }
}
