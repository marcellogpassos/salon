<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 15/07/2016
 * Time: 08:34
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;
use App\User;
use Illuminate\Support\Facades\DB;

class UsersRepository extends Repository {

    public function model() {
        return 'App\User';
    }

    public function sincronizarPapeis($id, array $roles) {
        $user = $this->find($id);
        return $user->roles()->sync($roles);
    }

    public function listarFuncionarios() {
        $funcionarios = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->orderBy(DB::raw('concat(name, " ", surname)'))
            ->select('users.*')
            ->distinct()
            ->get();
        return User::hydrate($funcionarios);
    }

}