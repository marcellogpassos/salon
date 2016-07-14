<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 23/06/2016
 * Time: 08:31
 */

namespace App\Services;


use App\Repositories\RolesRepository as Roles;

class RolesService implements RolesServiceInterface {

    protected $roles;

    public function __construct(Roles $repository) {
        $this->roles = $repository;
    }

    public function listarTodos() {
        return $this->roles->all();
    }

}