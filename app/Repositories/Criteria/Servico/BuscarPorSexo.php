<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 08/08/2016
 * Time: 16:23
 */

namespace App\Repositories\Criteria\Servico;


use App\Repositories\Contracts\RepositoryInterface as Repository;
use App\Repositories\Criteria\Criteria;

class BuscarPorSexo extends Criteria  {

    protected $sexo;

    public function __construct($sexo) {
        $this->sexo = $sexo;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where($this->sexo, '1');
        return $query;
    }

}