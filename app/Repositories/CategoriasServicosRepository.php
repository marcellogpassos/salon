<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 29/07/2016
 * Time: 10:58
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class CategoriasServicosRepository extends Repository {

    public function model() {
        return 'App\CategoriasServicos';
    }

}