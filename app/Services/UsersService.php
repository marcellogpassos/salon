<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 15/06/2016
 * Time: 22:04
 */

namespace App\Services;


use App\Repositories\Criteria\User\BuscarPorCPF;
use App\Repositories\Criteria\User\BuscarPorEmail;
use App\Repositories\Criteria\User\BuscarPorNomeSobrenome;
use App\Repositories\Criteria\User\BuscarPorSexo;
use App\Repositories\Criteria\User\BuscarPorTelefone;
use App\Repositories\Criteria\User\OrdenarPorNomeSobrenome;
use App\Repositories\UsersRepository as Users;
use Illuminate\Support\Facades\Auth;

class UsersService implements UsersServiceInterface {

    protected $users;

    public function __construct(Users $repository) {
        $this->users = $repository;
    }

    public function buscar($criterios) {
        if (filtroFornecido($criterios, 'email'))
            $this->users->pushCriteria(new BuscarPorEmail($criterios['email']));
        else if (filtroFornecido($criterios, 'cpf', 11))
            $this->users->pushCriteria(new BuscarPorCPF($criterios['cpf']));
        else {
            if (filtroFornecido($criterios, 'nome_sobrenome'))
                $this->users->pushCriteria(new BuscarPorNomeSobrenome($criterios['nome_sobrenome']));
            if (filtroFornecido($criterios, 'sexo'))
                $this->users->pushCriteria(new BuscarPorSexo($criterios['sexo']));
            if (filtroFornecido($criterios, 'telefone'))
                $this->users->pushCriteria(new BuscarPorTelefone($criterios['telefone']));
        }
        return $this->users->pushCriteria(new OrdenarPorNomeSobrenome())->paginate();
    }

    public function atualizarPropriosDados(array $attributes) {
        $id = Auth::user()->id;
        return $this->users->updateRich($attributes, $id);
    }

    public function getUser($id) {
        return $this->users->find($id);
    }

    public function sincronizarPapeis($userId, array $roles) {
        return $this->users->sincronizarPapeis($userId, $roles);
    }

}