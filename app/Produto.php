<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {

    public function categoria() {
        return $this->belongsTo('App\CategoriasProdutos');
    }

    public function marca() {
        return $this->belongsTo('App\MarcasProdutos');
    }

}
