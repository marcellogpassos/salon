<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {

	protected $fillable = [
		'descricao', 'categoria_id', 'marca_id', 'quantidade', 'codigo_barras'
	];

	public function categoria() {
		return $this->belongsTo('App\CategoriasProdutos');
	}

	public function marca() {
		return $this->belongsTo('App\MarcasProdutos');
	}

	public function itemVenda() {
		return $this->belongsTo('App\ItemVenda', 'id');
	}

}
