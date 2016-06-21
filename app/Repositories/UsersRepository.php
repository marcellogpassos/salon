<?php

namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\DB;

class UsersRepository implements UsersRepositoryInterface {

    protected $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function buscarPorCpf($cpf) {
        return $this->model->where('cpf', $cpf)->get();
    }

    public function buscarPorEmail($email) {
        return $this->model->where('email', $email)->get();
    }

    public function buscar($criterios) {
        $buscarPorEmail = (isset($criterios['email']) && strlen($criterios['email']) > 0);
        $buscarPorCpf = (isset($criterios['cpf']) && strlen($criterios['cpf']) == 11);
        $buscarPorSexo = isset($criterios['sexo']);
        $buscarPorTelefone = (isset($criterios['telefone']) && strlen($criterios['telefone']) > 0);
        $buscarPorNome = (isset($criterios['nome_sobrenome']) && strlen($criterios['nome_sobrenome']) > 0);
        $buscarPorOutrosCriterios = ($buscarPorSexo || $buscarPorTelefone || $buscarPorNome);

        if ($buscarPorCpf || $buscarPorEmail || $buscarPorOutrosCriterios) {
            $encontradosPeloEmail = ($buscarPorEmail) ?
                $this->model->where('email', $criterios['email']) : null;

            $encontradosPeloCpf = ($buscarPorCpf) ?
                $this->model->orWhere('cpf', $criterios['cpf']) : null;

            $encontrarPorOutrosCriterios = ($buscarPorTelefone) ?
                $this->model->where('telefone', $criterios['telefone']) : $this->model;
            $encontrarPorOutrosCriterios = ($buscarPorNome) ?
                $encontrarPorOutrosCriterios->where(
                    DB::raw('concat(name, " ", surname)'), 'like', '%' . $criterios['nome_sobrenome'] . '%'
                ) : $encontrarPorOutrosCriterios;
            $encontrarPorOutrosCriterios = ($buscarPorSexo) ?
                $encontrarPorOutrosCriterios->where('sexo', $criterios['sexo']) : $encontrarPorOutrosCriterios;

            $query = $this->montarQuery($encontradosPeloEmail, $encontradosPeloCpf, $buscarPorOutrosCriterios,
                $encontrarPorOutrosCriterios);

            return $query->get();
        }

        return null;
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

    private function montarQuery($encontradosPeloEmail, $encontradosPeloCpf, $buscarPorOutrosCriterios,
                                 $encontrarPorOutrosCriterios) {
        $query = null;
        if ($encontradosPeloEmail) {
            $query = $encontradosPeloEmail;
            $query = ($encontradosPeloCpf) ? $query->union($encontradosPeloCpf) : $query;
            $query = ($buscarPorOutrosCriterios) ? $query->union($encontrarPorOutrosCriterios) : $query;
        } else if ($encontradosPeloCpf) {
            $query = $encontradosPeloCpf;
            $query = ($buscarPorOutrosCriterios) ? $query->union($encontrarPorOutrosCriterios) : $query;
        } else {
            $query = $encontrarPorOutrosCriterios;
        }
        return $query;
    }

}