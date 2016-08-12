<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 27/07/2016
 * Time: 10:39
 */

namespace App\Services;

use App\Repositories\Criteria\BuscarPorDescricao;
use App\Repositories\Criteria\OrdenarPorDescricao;
use App\Repositories\Criteria\Produto\BuscarPorCategoria;
use App\Repositories\Criteria\Produto\BuscarPorId;
use App\Repositories\Criteria\Servico\BuscarPorSexo;
use App\Repositories\ServicosRepository as Servicos;
use App\Repositories\ItemVendaRepository as ItensVenda;
use App\Servico;

class ServicoService implements ServicoServiceInterface {

    protected $servicos;

    protected $itensVenda;

    public function __construct(Servicos $repository, ItensVenda $itemVendaRepository) {
        $this->servicos = $repository;
        $this->itensVenda = $itemVendaRepository;
    }

    public function cadastrar(array $servicoAttr, array $itemVendaAttr) {
        $itemVenda = $this->itensVenda->create($itemVendaAttr);
        $servico = new Servico($servicoAttr);
        return $itemVenda->servico()->save($servico);
    }

    public function definirFuncionariosHabilitados($id, array $funcionarios) {
        return $this->servicos->sincronizarFuncionarios($id, $funcionarios);
    }

    public function buscar($criterios) {
        if (filtroFornecido($criterios, 'id'))
            $this->servicos->pushCriteria(new BuscarPorId($criterios['id']))->paginate();
        else {
            if (filtroFornecido($criterios, 'descricao'))
                $this->servicos->pushCriteria(new BuscarPorDescricao($criterios['descricao']));
            if (filtroFornecido($criterios, 'categoria_id'))
                $this->servicos->pushCriteria(new BuscarPorCategoria($criterios['categoria_id']));
            if (filtroFornecido($criterios, 'masculino') && !filtroFornecido($criterios, 'feminino'))
                $this->servicos->pushCriteria(new BuscarPorSexo('masculino'));
            if (filtroFornecido($criterios, 'feminino') && !filtroFornecido($criterios, 'masculino'))
                $this->servicos->pushCriteria(new BuscarPorSexo('feminino'));
        }
        return $this->servicos->pushCriteria(new OrdenarPorDescricao())->paginate();
    }

    public function listarTodasOrdenarPorDescricao() {
        return $this->servicos->getByCriteria(new OrdenarPorDescricao())->paginate();
    }

    public function getById($id) {
        return $this->servicos->find($id);
    }

    public function editar($id, array $servicoAttr, array $itemVendaAttr) {
        return $this->itensVenda->updateItemVendaServico($servicoAttr, $itemVendaAttr, $id);
    }

    public function deletar($id) {
        $servico = $this->servicos->find($id);
        if($servico)
            return $this->itensVenda->delete($id);
        return false;
    }

}