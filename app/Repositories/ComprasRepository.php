<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 04/10/2016
 * Time: 18:05
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class ComprasRepository extends Repository {

    public function model() {
        return 'App\Compra';
    }

}