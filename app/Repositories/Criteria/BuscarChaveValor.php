<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 18:42
 */

namespace App\Repositories\Criteria;


use App\Repositories\Contracts\RepositoryInterface as Repository;

abstract class BuscarChaveValor extends Criteria {

    protected $valor;

    public function __construct($valor) {
        $this->valor = $valor;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where($this->getChave(), $this->valor);
        return $query;
    }

    public abstract function getChave();

}