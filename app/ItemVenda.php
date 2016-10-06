<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model {

    protected $table = 'itens_venda';

    protected $fillable = [
        'id', 'ativo', 'valor'
    ];

    public function produto() {
        return $this->hasOne('App\Produto', 'id');
    }

    public function servico() {
        return $this->hasOne('App\Servico', 'id');
    }

    public function eProduto() {
        return isset($this->produto);
    }

    public function eServico() {
        return isset($this->servico);
    }

    public function descricao() {
        if($this->eProduto())
            return $this->produto->descricao . ' (' . $this->produto->marca->descricao . ')';
        if($this->eServico())
            return $this->servico->descricao;
        return null;
    }

}
