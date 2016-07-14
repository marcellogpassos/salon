<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 28/06/2016
 * Time: 09:50
 */

namespace App\Services;

use App\Repositories\MarcasProdutosRepository as MrcProdutos;

class MarcasProdutosService implements MarcasProdutosServiceInterface {

    protected $mrcProdutos;

    public function __construct(MrcProdutos $repository) {
        $this->mrcProdutos = $repository;
    }

    public function listarTodasOrdenarPorDescricao() {
        return $this->mrcProdutos->all();
    }

    public function atualizar($id, array $attributes) {
        if (!$attributes)
            abort(400);
        return $this->mrcProdutos->updateRich($attributes, $id);
    }

    public function cadastrar(array $attributes) {
        if (!$attributes)
            abort(400);
        return $this->mrcProdutos->create($attributes);
    }

    public function deletar($id) {
        return $this->mrcProdutos->delete($id);
    }

    public function getById($id) {
        return $this->mrcProdutos->find($id);
    }
}