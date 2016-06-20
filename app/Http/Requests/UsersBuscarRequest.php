<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersBuscarRequest extends Request {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function all() {
        $attributes = parent::all();

        $attributes['cpf'] = preg_replace("/[^0-9]/", '', $attributes['cpf']);
        $attributes['telefone'] = preg_replace("/[^0-9]/", '', $attributes['telefone']);

        $this->replace($attributes);

        return parent::all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'nome_sobrenome' => 'min:3|max:255|required_without_all:telefone,cpf,email',
            'email' => 'max:255|email|required_without_all:telefone,cpf,nome_sobrenome',
            'sexo' => 'in:M,F|required_without_all:telefone,cpf,email,nome_sobrenome',
            'cpf' => 'size:11|required_without_all:telefone,email,nome_sobrenome',
            'telefone' => 'min:10|max:11|required_without_all:cpf,email,nome_sobrenome',
        ];
    }
}
