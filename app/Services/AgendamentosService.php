<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 03/12/2016
 * Time: 20:59
 */

namespace App\Services;


use App\Repositories\AgendamentosRepository;
use Carbon\Carbon;

class AgendamentosService implements AgendamentosServiceInterface {

	protected $agendamentosRepository;

	public function __construct(AgendamentosRepository $repository) {
		$this->agendamentosRepository = $repository;
	}

	public function listarTodos() {
		return $this->agendamentosRepository->all();
	}

	public function listarAgendamentosPorUsuario($userId) {
		$hoje = Carbon::today();
		return $this->agendamentosRepository->findWhere([
			'cliente_id' => $userId,
			['data', '>=', $hoje]
		]);
	}

	public function cadastrarAgendamento() {
		// TODO: Implement cadastrarAgendamento() method.
	}
}