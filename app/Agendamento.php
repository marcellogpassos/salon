<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model {

	const INDETERMINADO = 'I';
	const CONFIRMADO = 'C';
	const NEGADO = 'N';

	protected $table = 'agendamentos';

	protected $fillable = [
		'data', 'hora', 'cliente_id', 'servico_id', 'profissional_id', 'status', 'justificativa'
	];

	public function cliente() {
		return $this->belongsTo('App\User', 'cliente_id');
	}

	public function servico() {
		return $this->belongsTo('App\Servico', 'servico_id');
	}

	public function profissional() {
		return $this->belongsTo('App\User', 'profissional_id');
	}

	public function getCarbonDateTime() {
		return new Carbon($this->data . ' ' . $this->hora);
	}

	public static function getStatusName($status) {
		switch ($status) {
			case Agendamento::INDETERMINADO:
				return 'Indeterminado';
				break;
			case Agendamento::CONFIRMADO:
				return 'Confirmado';
				break;
			case Agendamento::NEGADO:
				return 'Negado';
				break;
			default:
				return 'Indeterminado';
		}
	}

}
