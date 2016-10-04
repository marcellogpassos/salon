<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 12/08/2016
 * Time: 22:06
 */

namespace App\Services;

use App\Repositories\FormasPagamentoRepository as FormasPagamento;

class FormasPagamentoService implements FormasPagamentoServiceInterface {

	protected $formasPagamento;

	public function __construct(FormasPagamento $repository) {
		$this->formasPagamento = $repository;
	}

	public function listarTodos() {
		return $this->formasPagamento->all();
	}

	public function getFormaPagamento($id) {
		return $this->formasPagamento->find($id);
	}
}