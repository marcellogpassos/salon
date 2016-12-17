<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 19/07/2016
 * Time: 11:15
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class ItemVendaRepository extends Repository {

    public function model() {
        return 'App\ItemVenda';
    }

    public function updateItemVendaProduto(array $produtoAttr, array $itemVendaAttr, $id) {
        $parent = $this->find($id);
        $parent->fill($itemVendaAttr);
        $parent->save();
        $child = $parent->produto;
        $child->descricao = $produtoAttr['descricao'];
        $child->categoria_id = $produtoAttr['categoria_id'];
        $child->marca_id = $produtoAttr['marca_id'];
        $child->quantidade = $produtoAttr['quantidade'];
        $child->codigo_barras = $produtoAttr['codigo_barras'];
        $parent->produto()->save($child);
        return $parent;
    }

    public function updateItemVendaServico(array $servicoAttr, array $itemVendaAttr, $id) {
        $parent = $this->find($id);
        $parent->fill($itemVendaAttr);
        $parent->save();
        $child = $parent->servico;
        $child->descricao = $servicoAttr['descricao'];
        $child->categoria_id = $servicoAttr['categoria_id'];
        $child->masculino = $servicoAttr['masculino'];
        $child->feminino = $servicoAttr['feminino'];
        $child->duracao = $servicoAttr['duracao'];
        $parent->servico()->save($child);
        return $parent;
    }

}