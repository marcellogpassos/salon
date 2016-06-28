<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 28/06/2016
 * Time: 09:45
 */

namespace App\Repositories;


use App\MarcasProdutos;

class MarcasProdutosRepository implements MarcasProdutosRepositoryInterface {

    protected $model;

    public function __construct(MarcasProdutos $model) {
        $this->model = $model;
    }

    public function getAll($orderBy) {
        if (!$orderBy)
            return $this->model->all();
        return $this->model->orderBy($orderBy)->get();
    }

    public function create(array $attributes) {
        return $this->model->create($attributes);
    }
    
}