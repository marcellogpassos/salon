<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 06/07/2016
 * Time: 09:43
 */

namespace App\Services;


use App\ItemVenda;
use App\Produto;
use App\Repositories\Criteria\BuscarChaveValor;
use App\Repositories\Criteria\BuscarPorDescricao;
use App\Repositories\Criteria\OrdenarPorDescricao;
use App\Repositories\Criteria\Produto\BuscarPorCategoria;
use App\Repositories\Criteria\Produto\BuscarPorId;
use App\Repositories\Criteria\Produto\BuscarPorMarca;
use App\Repositories\ProdutosRepository as Produtos;
use App\Repositories\ItemVendaRepository as ItensVenda;

class ProdutosService implements ProdutosServiceInterface {

    protected $produtos;

    protected $itensVenda;

    public function __construct(Produtos $repository, ItensVenda $itemVendaRepository) {
        $this->produtos = $repository;
        $this->itensVenda = $itemVendaRepository;
    }

    public function listarTodasOrdenarPorDescricao() {
        return $this->produtos->getByCriteria(new OrdenarPorDescricao())->paginate();
    }

    public function buscar($criterios) {
        if (filtroFornecido($criterios, 'id'))
            $this->produtos->pushCriteria(new BuscarPorId($criterios['id']))->paginate();
        if (filtroFornecido($criterios, 'codigo_barras'))
            return $this->produtos->findWhere(['codigo_barras' => $criterios['codigo_barras']], true);
        else {
            if (filtroFornecido($criterios, 'descricao'))
                $this->produtos->pushCriteria(new BuscarPorDescricao($criterios['descricao']));
            if (filtroFornecido($criterios, 'categoria_id'))
                $this->produtos->pushCriteria(new BuscarPorCategoria($criterios['categoria_id']));
            if (filtroFornecido($criterios, 'marca_id'))
                $this->produtos->pushCriteria(new BuscarPorMarca($criterios['marca_id']));
        }
        return $this->produtos->pushCriteria(new OrdenarPorDescricao())->paginate();
    }

    public function buscarPeloId($id) {
        return $this->produtos->findBy('id', $id);
    }

    public function deletar($id) {
        $produto = $this->produtos->find($id);
        if ($produto)
            return $this->itensVenda->delete($id);
        return false;
    }

    public function getById($id) {
        return $this->produtos->find($id);
    }

    public function cadastrar(array $produtoAttr, array $itemVendaAttr) {
        $itemVenda = $this->itensVenda->create($itemVendaAttr);
        $produto = new Produto($produtoAttr);
        return $itemVenda->produto()->save($produto);
    }

    public function editar($id, array $produtoAttr, array $itemVendaAttr) {
        return $this->itensVenda->updateItemVendaProduto($produtoAttr, $itemVendaAttr, $id);
    }

    public function decrementarQuantidade($produto, $quantidade) {
        if ($produto->quantidade >= $quantidade) {
            $produto->quantidade -= $quantidade;
            $produto->save();
        }
    }

}