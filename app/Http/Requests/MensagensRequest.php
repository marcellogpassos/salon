<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MensagensRequest extends Request {

	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'destinatario_id' => 'required|exists:users,id',
			'assunto' => 'required|max:255',
			'mensagem' => 'required|max:2048'
		];
	}
}
