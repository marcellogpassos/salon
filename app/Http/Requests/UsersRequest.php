<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function all()
    {
        $attributes = parent::all();

        $attributes['cpf'] = preg_replace("/[^0-9]/", '', $attributes['cpf']);
        $attributes['telefone'] = preg_replace("/[^0-9]/", '', $attributes['telefone']);

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
            'cpf' => 'required|size:11',
            'data_nascimento' => 'required|date_format:Y-m-d|before:tomorrow',
            'telefone' => 'size:11'
        ];
    }
}
