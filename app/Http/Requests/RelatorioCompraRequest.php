<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class RelatorioCompraRequest extends Request {

    protected $sanitized = false;

    public function authorize() {
        return true;
    }

    public function all() {
        $attributes = parent::all();

        if ($this->sanitized)
            return $attributes;

        if (isset($attributes['valor_minimo']))
            $attributes['valor_minimo'] = tratarInputValoresMonetarios($attributes['valor_minimo']);
        if (isset($attributes['valor_maximo']))
            $attributes['valor_maximo'] = tratarInputValoresMonetarios($attributes['valor_maximo']);

        $this->replace($attributes);
        $this->sanitized = true;

        return parent::all();
    }

    public function rules() {
        return [
            'codigo_validacao' => 'alpha_num',
            'cliente' => 'exists:users,id',
            'item' => 'exists:itens_venda,id',
            'data_inicial' => 'date|before:tomorrow' . $this->getDataInicialRule(),
            'data_final' => 'date|before:tomorrow' . $this->getDataFinalRule(),
            'valor_minimo' => 'numeric|min:0',
            'valor_maximo' => 'numeric|min:0'
        ];
    }

    private function getDataInicialRule() {
        $attributes = $this->all();
        $data_final = isset($attributes['data_final']) ?
            $data_final = date('Y-m-d', strtotime($attributes['data_final']) + 86400) : null;
        $data_final ? '|before:' . $data_final : '';
    }

    private function getDataFinalRule() {
        $attributes = $this->all();
        $data_inicial = isset($attributes['data_inicial']) ?
            $data_inicial = date('Y-m-d', strtotime($attributes['data_inicial']) - 86400) : null;
        return $data_inicial ? '|after:' . $data_inicial : '';
    }
}
