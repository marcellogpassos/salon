<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

abstract class ItemVendaRequest extends Request {

    protected $sanitized = false;

    protected $rules;

    public function __construct() {
        $parentRules = [
            'id' => 'integer|unique:itens_venda,id',
            'descricao' => 'required|min:3|max:255',
            'valor' => 'required|numeric',
            'ativo' => 'required|in:1,0'
        ];
        $collection = collect($parentRules);
        $merged = $collection->merge($this->subclassRules());
        $this->rules = $merged->all();
    }

    public function authorize() {
        return true;
    }

    public function all() {
        $attributes = parent::all();

        if ($this->sanitized)
            return $attributes;

        $attributes = $this->subclassAll($attributes);
        $attributes['descricao'] = strtoupper($attributes['descricao']);
        $attributes['valor'] = tratarInputValoresMonetarios($attributes['valor'], 2);

        $this->replace($attributes);
        $this->sanitized = true;

        return parent::all();
    }

    public function rules() {
        return $this->rules;
    }

    public abstract function subclassAll($attributes);

    public abstract function subclassRules();

}
