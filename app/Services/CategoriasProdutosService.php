<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 11/07/2016
 * Time: 16:02
 */

namespace App\Services;


use App\Repositories\CategoriasProdutosRepositoryInterface;

class CategoriasProdutosService implements CategoriasProdutosServiceInterface {

    protected $categoriasProdutosRepository;

    public function __construct(CategoriasProdutosRepositoryInterface $repository) {
        $this->categoriasProdutosRepository = $repository;
    }

    public function listarTodasOrdenarPorDescricao() {
        return $this->categoriasProdutosRepository->getAll('descricao');
    }

}