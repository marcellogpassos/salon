<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model {

	protected $table = 'agendamentos';

	protected $fillable = [
		'data', 'hora', 'cliente_id', 'servico_id', 'profissional_id', 'status', 'justificativa'
	];

}
