<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 18:18
 */

namespace App\Repositories\Criteria;


use App\Repositories\Contracts\RepositoryInterface as Repository;
use App\Repositories\Criteria\Criteria;

class BuscarPorDescricao extends Criteria{

    protected $descricao;

    public function __construct($descricao) {
        $this->descricao = $descricao;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where('descricao', 'like', '%' . $this->descricao . '%');
        return $query;
    }

}