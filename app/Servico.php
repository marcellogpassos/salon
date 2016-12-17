<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model {

	protected $fillable = [
		'descricao', 'categoria_id', 'masculino', 'feminino', 'duracao'
	];

	public function categoria() {
		return $this->belongsTo('App\CategoriasServicos');
	}

	public function itemVenda() {
		return $this->belongsTo('App\ItemVenda', 'id');
	}

	public function funcionariosHabilitados() {
		return $this->belongsToMany('App\User');
	}

}