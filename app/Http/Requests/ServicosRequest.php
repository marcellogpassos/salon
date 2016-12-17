<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServicosRequest extends ItemVendaRequest {

    public function subclassAll($attributes) {
        if (!isset($attributes['feminino']))
            $attributes = array_add($attributes, 'feminino', '0');
        if (!isset($attributes['masculino']))
            $attributes = array_add($attributes, 'masculino', '0');
        return $attributes;
    }

    public function subclassRules() {
        return [
            'categoria_id' => 'required|exists:categorias_servicos,id',
            'masculino' => 'in:1,0',
            'feminino' => 'in:1,0',
            'duracao' => 'required|date_format:H:i:s'
        ];
    }

}
