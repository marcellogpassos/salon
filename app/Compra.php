<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model {

    protected $table = 'compras';

    protected $fillable = [
        'data_compra', 'cliente_id', 'caixa_id', 'valor_total', 'desconto', 'forma_pagamento_id', 'bandeira_cartao_id',
        'codigo_validacao'
    ];

    public function cliente() {
        return $this->belongsTo('App\User', 'cliente_id');
    }

    public function caixa() {
        return $this->belongsTo('App\User', 'caixa_id');
    }

    public function formaPagamento() {
        return $this->belongsTo('App\FormaPagamento', 'forma_pagamento_id');
    }

    public function bandeiraCartao() {
        return $this->belongsTo('App\BandeiraCartao', 'bandeira_cartao_id');
    }

    public function itensCompra() {
        return $this->hasMany('App\ItemCompra', 'compra_id');
    }

}