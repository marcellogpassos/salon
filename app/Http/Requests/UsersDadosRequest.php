<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersDadosRequest extends Request {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'sexo' => 'required|in:M,F',
            'cpf' => 'size:11|unique:users,cpf,' . $this->user()->id,
            'data_nascimento' => 'required|date_format:Y-m-d|before:tomorrow',
            'telefone' => 'required|min:10|max:11',
            'cep' => 'required|size:8',
            'municipio_id' => 'required|size:7',
            'logradouro' => 'required|max:255',
            'numero' => 'required|max:16',
            'bairro' => 'required|max:255',
            'complemento' => 'max:255',
            'foto' => 'image|dimensions:min_width=100,min_height=100,max_width=2048,max_height=2048'
        ];
    }
}
