<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContasExcluidasRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'password' => 'required|max:255',
            'stars' => 'numeric|between:1,5',
            'motivo' => 'max:2048'
        ];
    }
}
