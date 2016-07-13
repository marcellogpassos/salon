<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 06/07/2016
 * Time: 09:43
 */

namespace App\Services;


use App\Repositories\ProdutosRepositoryInterface;

class ProdutosService implements ProdutosServiceInterface {

    protected $produtosRepository;

    public function __construct(ProdutosRepositoryInterface $repository) {
        $this->produtosRepository = $repository;
    }

    public function listarTodasOrdenarPorDescricao() {
        return $this->produtosRepository->getAll('descricao');
    }

    public function buscar($criterios) {
        return $this->produtosRepository->buscar($criterios);
    }

    public function deletar($id) {
        return $this->produtosRepository->delete($id);
    }

    public function getById($id) {
        return $this->produtosRepository->getById($id);
    }
}