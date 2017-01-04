<?php

namespace App;

use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

	protected $fillable = [
		'name', 'surname', 'sexo', 'cpf', 'data_nascimento', 'telefone', 'email', 'password', 'cep', 'uf', 'municipio',
		'logradouro', 'numero', 'bairro', 'complemento', 'dados_atualizados'
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function roles() {
		return $this->belongsToMany('App\Role');
	}

	public function municipio() {
		return $this->belongsTo('App\Municipio', 'municipio_id');
	}

	public function servicos() {
		return $this->belongsToMany('App\Servico');
	}

	public function agendamentos() {
		return $this->hasMany('App\Agendamento', 'cliente_id');
	}

	public function mensagensEnviadas() {
		return $this->hasMany('App\Mensagem', 'remetente_id');
	}

	public function mensagensRecebidas() {
		return $this->hasMany('App\Mensagem', 'destinatario_id');
	}

	public function possuiRole($roleProcurado) {
		foreach ($this->roles as $role)
			if ($role->id == $roleProcurado)
				return true;
		return false;
	}

	public function admin() {
		return $this->possuiRole(Role::ADMIN);
	}

}
