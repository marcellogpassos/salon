<?php namespace App\Repositories;

use App\Repositories\Eloquent\Repository;

class CategoriasProdutosRepository extends Repository {

    public function model() {
        return 'App\CategoriasProdutos';
    }
    
}