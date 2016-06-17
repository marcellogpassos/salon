<?php

namespace App\Repositories;


use App\User;

class UsersRepository implements UsersRepositoryInterface {

    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function buscar($criterios) {
        $found = $this->model;

        if(isset( $criterios['sexo'] ))
            $found = $found->orWhere('sexo', $criterios['sexo']);
        if(isset( $criterios['cpf'] ))
            $found = $found->orWhere('cpf', $criterios['cpf']);
        if(isset( $criterios['telefone'] ))
            $found = $found->orWhere('telefone', $criterios['telefone']);
        if($criterios['email'] && strlen($criterios['email']) > 0)
            $found = $found->orWhere('email', 'like', '%' . $criterios['email'] . '%');
        if(isset( $criterios['nome'] ) && strlen($criterios['nome']) > 0)
            $found = $found->orWhere('nome', 'like', '%' . $criterios['nome'] . '%');

        return $found->get();
    }

    public function getAll() {
        return $this->model->all();
    }

    public function getById($id) {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes) {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes) {
        $user = $this->model->findOrFail($id);
        $user->update($attributes);
        return $user;
    }

    public function delete($id) {
        return $this->getById($id)->delete();
        return true;
    }

}