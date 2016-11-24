<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model {

	protected $table = 'municipios';

	public function uf () {
		return $this->belongsTo('App\Uf', 'uf_id');
	}

}
