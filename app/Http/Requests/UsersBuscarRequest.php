<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersBuscarRequest extends Request {

    public function authorize() {
        return true;
    }

    public function all() {
        $attributes = parent::all();

        if (isset($attributes['cpf']))
            $attributes['cpf'] = preg_replace("/[^0-9]/", '', $attributes['cpf']);
        if (isset($attributes['telefone']))
            $attributes['telefone'] = preg_replace("/[^0-9]/", '', $attributes['telefone']);

        $this->replace($attributes);

        return parent::all();
    }

    public function rules() {
        return [
            'nome_sobrenome' => 'min:3|max:255',
            'email' => 'max:255|email',
            'sexo' => 'in:M,F',
            'cpf' => 'size:11',
            'telefone' => 'min:10|max:11',
        ];
    }
}
