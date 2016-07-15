<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 15/07/2016
 * Time: 09:19
 */

namespace App\Repositories\Criteria\User;


use App\Repositories\Criteria\Criteria;
use App\Repositories\Contracts\RepositoryInterface as Repository;
use Illuminate\Support\Facades\DB;

class OrdenarPorNomeSobrenome extends Criteria {

    public function apply($model, Repository $repository) {
        $query = $model->orderBy(DB::raw('concat(name, " ", surname)'));
        return $query;
    }

}