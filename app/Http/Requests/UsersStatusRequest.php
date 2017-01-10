<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersStatusRequest extends Request {

	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'id' => 'required|exists:users,id',
			'ativo' => 'required|in:1,0'
		];
	}
}
