<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MarcasProdutosRequest extends Request {

    public function authorize() {
        return true;
    }

    public function all() {
        $attributes = parent::all();

        $attributes['descricao'] = strtoupper($attributes['descricao']);
        $attributes['telefone_fornecedor'] = preg_replace("/[^0-9]/", '', $attributes['telefone_fornecedor']);

        $this->replace($attributes);

        return parent::all();
    }

    public function rules() {
        return [
            'descricao' => 'min:3|max:255|required|unique:marcas_produtos,descricao,' . $this->route('id'),
            'website' => 'max:255|url',
            'nome_fornecedor' => 'max:255',
            'email_fornecedor' => 'max:255|email',
            'telefone_fornecedor' => 'min:10|max:11',
        ];
    }
}
