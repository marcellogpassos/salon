<?php

namespace App\Repositories;


use App\User;

class UsersRepository implements UsersRepositoryInterface {

    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
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