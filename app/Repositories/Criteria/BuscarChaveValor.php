<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 18:42
 */

namespace App\Repositories\Criteria;


use App\Repositories\Contracts\RepositoryInterface as Repository;

class BuscarChaveValor extends Criteria{

    protected $chave;

    protected $valor;

    public function __construct($chave, $valor) {
        $this->chave = $chave;
        $this->valor = $valor;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where($this->chave, $this->valor);
        return $query;
    }
}