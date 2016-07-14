<?php

namespace App\Repositories\Criteria\Produto;

use App\Repositories\Criteria\Criteria;
use App\Repositories\Contracts\RepositoryInterface as Repository;
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 18:52
 */
class BuscarPorMarca extends Criteria {

    protected $marcaId;

    public function __construct($marcaId) {
        $this->marcaId = $marcaId;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where('marca_id', $this->marcaId);
        return $query;
    }

}