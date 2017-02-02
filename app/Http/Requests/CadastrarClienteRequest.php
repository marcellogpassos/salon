<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CadastrarClienteRequest extends Request {

	public function authorize() {
		return true;
	}

	public function all() {
		$attributes = parent::all();

		$attributes['cpf'] = preg_replace("/[^0-9]/", '', $attributes['cpf']);
		$attributes['telefone'] = preg_replace("/[^0-9]/", '', $attributes['telefone']);
		$attributes['cep'] = preg_replace("/[^0-9]/", '', $attributes['cep']);
		$attributes['municipio_id'] = preg_replace("/[^0-9]/", '', $attributes['municipio_id']);

		$this->replace($attributes);

		return parent::all();
	}

	public function rules() {
		return [
			'name' => 'required|max:255',
			'surname' => 'required|max:255',
			'sexo' => 'required|in:M,F',
			'cpf' => 'size:11|unique:users,cpf,' . $this->user()->id,
			'data_nascimento' => 'required|date_format:Y-m-d|before:tomorrow',
			'telefone' => 'required|min:10|max:11',
			'cep' => 'size:8',
			'municipio_id' => 'size:7',
			'logradouro' => 'max:255',
			'numero' => 'max:16',
			'bairro' => 'max:255',
			'complemento' => 'max:255',
			'email' => 'email|max:255|unique:users,email'
		];
	}

}
