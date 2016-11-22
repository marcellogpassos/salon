<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProdutosRequest extends ItemVendaRequest {

    public function subclassAll($attributes) {
        return $attributes;
    }

    public function subclassRules() {
        return [
            'categoria_id' => 'required|exists:categorias_produtos,id',
            'marca_id' => 'exists:marcas_produtos,id',
            'quantidade' => 'required|integer',
            'codigo_barras' => 'digits_between:8,13'
        ];
    }
}
