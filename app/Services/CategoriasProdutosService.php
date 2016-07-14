<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 11/07/2016
 * Time: 16:02
 */

namespace App\Services;

use App\Repositories\CategoriasProdutosRepository as CatProdutos;

class CategoriasProdutosService implements CategoriasProdutosServiceInterface {

    protected $catProdutos;

    public function __construct(CatProdutos $repository) {
        $this->catProdutos = $repository;
    }

    public function listarTodos() {
        return $this->catProdutos->all();
    }

}