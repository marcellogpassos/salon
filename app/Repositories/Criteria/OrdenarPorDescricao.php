<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 18:34
 */

namespace App\Repositories\Criteria;


use App\Repositories\Contracts\RepositoryInterface as Repository;

class OrdenarPorDescricao extends Criteria {

    public function apply($model, Repository $repository) {
        $query = $model->orderBy('descricao');
        return $query;
    }
    
}