<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 27/07/2016
 * Time: 10:39
 */

namespace App\Services;

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

}