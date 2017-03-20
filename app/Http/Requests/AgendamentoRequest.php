<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AgendamentoRequest extends Request {

	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'data' => 'required|date|after:yesterday',
			'hora' => 'required|date_format:H:i',
		];
	}
}
