<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProdutosBuscarRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id'            => 'numeric',
            'descricao'     => 'min:3|max:255',
            'categoria_id'  => 'numeric|exists:categorias_produtos,id',
            'marca_id'      => 'numeric|exists:marcas_produtos,id',
            'codigo_barras' => 'min:8|max:13|alpha_num'
        ];
    }
}
