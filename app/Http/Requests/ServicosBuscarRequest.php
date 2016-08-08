<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServicosBuscarRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id'            => 'numeric',
            'descricao'     => 'min:3|max:255',
            'categoria_id'  => 'numeric|exists:categorias_servicos,id',
            'masculino'     => 'in:1,0',
            'feminino'     => 'in:1,0'
        ];
    }
}
