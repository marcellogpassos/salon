<?php

namespace App;

use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    protected $fillable = [
        'name', 'surname', 'sexo', 'cpf', 'data_nascimento', 'telefone', 'email', 'password', 'cep', 'uf', 'municipio',
        'logradouro', 'numero', 'bairro', 'complemento'
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

    public function possuiRole($roleProcurado) {
        foreach ($this->roles as $role)
            if ($role->id == $roleProcurado->id)
                return true;
        return false;
    }
}
