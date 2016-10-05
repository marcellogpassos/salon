<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model {

    protected $table = 'item_compra';

    protected $fillable = [
        'item_id', 'compra_id', 'quantidade', 'valor_unitario_corrente'
    ];

    public function compra() {
        return $this->belongsTo('App\Compra', 'compra_id');
    }

    public function item() {
        return $this->belongsTo('App\ItemVenda', 'item_id');
    }

}
