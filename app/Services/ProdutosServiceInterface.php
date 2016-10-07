<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 06/07/2016
 * Time: 09:43
 */

namespace App\Services;


interface ProdutosServiceInterface {

    public function listarTodasOrdenarPorDescricao();

    public function buscar($criterios);

    public function buscarPeloId($id);

    public function deletar($id);

    public function getById($id);

    public function cadastrar(array $produtoAttr, array $itemVendaAttr);

    public function editar($id, array $produtoAttr, array $itemVendaAttr);

    public function decrementarQuantidade($id, $quantidade);

}