<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivrosRegister extends FormRequest
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
            'TituloLivro' => 'string',
            'Edicao' => 'integer',
            'Volume' => 'integer',
            'quantidade'=> 'integer|  min:1',
            'ISBN' => 'string|unique:livros',
            'Autor' => 'string',
            'Genero' => 'string',
            'Editora' => 'string',
        ];
    }

    public function messages()
    {
        return[
            'integer' => 'Somente números devem ser cadastrados em :attribute',
            'unique' => 'ISBN já cadastrado!',
            'min'=> 'A :atrribute deve ser de mínimo 1'
        ];
    }
}
