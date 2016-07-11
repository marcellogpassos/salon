<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 11/07/2016
 * Time: 15:59
 */

namespace App\Repositories;


use App\CategoriasProdutos;

class CategoriasProdutosRepository implements CategoriasProdutosRepositoryInterface {

    protected $model;

    public function __construct(CategoriasProdutos $model) {
        $this->model = $model;
    }

    public function getAll($orderBy) {
        if (!$orderBy)
            return $this->model->all();
        return $this->model->orderBy($orderBy)->get();
    }

}