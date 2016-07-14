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
class BuscarPorCategoria extends Criteria {

    protected $categoriaId;

    public function __construct($categoriaId) {
        $this->categoriaId = $categoriaId;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where('categoria_id', $this->categoriaId);
        return $query;
    }

}