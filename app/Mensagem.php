<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model {

	protected $table = 'mensagens';

	protected $fillable = ['remetente_id', 'destinatario_id', 'assunto', 'mensagem', 'lida'];

	public function remetente() {
		return $this->belongsTo('App\User', 'remetente_id');
	}

	public function destinatario() {
		return $this->belongsTo('App\User', 'destinatario_id');
	}

}
