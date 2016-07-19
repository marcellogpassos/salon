<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProdutosRequest extends Request {

    protected $sanitized = false;

    public function authorize() {
        return true;
    }

    public function all() {
        $attributes = parent::all();

        if ($this->sanitized)
            return $attributes;

        $attributes['descricao'] = strtoupper($attributes['descricao']);
        $valor = str_replace('R$ ', '', $attributes['valor']);
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $attributes['valor'] = round($valor, 2);

        $this->replace($attributes);
        $this->sanitized = true;

        return parent::all();
    }

    public function rules() {
        return [
            'id' => 'integer|unique:itens_venda,id,' . $this->getProdutoId(),
            'descricao' => 'required|min:3|max:255',
            'categoria_id' => 'required|exists:categorias_produtos,id',
            'marca_id' => 'exists:marcas_produtos,id',
            'quantidade' => 'required|integer',
            'valor' => 'required|numeric',
            'ativo' => 'required|in:1,0'
        ];
    }

    public function getProdutoId() {
        return $this->route('id');
    }
}
