<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 29/07/2016
 * Time: 11:00
 */

namespace App\Services;

use App\Repositories\CategoriasServicosRepository as CatServicos;

class CategoriasServicosService implements CategoriasServicosServiceInterface {

    protected $catServicos;

    public function __construct(CatServicos $repository) {
        $this->catServicos = $repository;
    }

    public function listarTodos() {
        return $this->catServicos->all();
    }

}