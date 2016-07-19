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

}
