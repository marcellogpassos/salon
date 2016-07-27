<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model {

	protected $fillable = [
		'descricao', 'categoria_id', 'masculino', 'feminino'
	];

	public function categoria() {
		return $this->belongsTo('App\CategoriasServicos');
	}

	public function itemVenda() {
		return $this->belongsTo('App\ItemVenda', 'id');
	}

}