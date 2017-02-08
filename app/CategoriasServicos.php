<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriasServicos extends Model {

	protected $table = 'categorias_servicos';

	public function servicos() {
		return $this->hasMany('App\Servico', 'categoria_id');
	}

}
