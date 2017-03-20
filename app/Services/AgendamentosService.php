<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 03/12/2016
 * Time: 20:59
 */

namespace App\Services;


use App\Agendamento;
use App\Repositories\AgendamentosRepository;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AgendamentosService implements AgendamentosServiceInterface {

	protected $agendamentosRepository;

	protected $usersService;

	public function __construct(AgendamentosRepository $repository,
								UsersServiceInterface $usersService) {
		$this->agendamentosRepository = $repository;
		$this->usersService = $usersService;
	}

	public function listarTodos() {
		return $this->agendamentosRepository->all();
	}

	public function listarAgendamentosPorUsuario($clienteId) {
		$hoje = Carbon::today();
		$agendamentos = Agendamento::where('cliente_id', $clienteId)
			->where('data', '>=', $hoje)
			->whereNull('data_cancelamento')
			->get();
		return $agendamentos;
	}

	public function cadastrarAgendamento($clienteId, array $atributos) {

		if (!$atributos['profissional_id'])
			$atributos = array_except($atributos, ['profissional_id']);

		$agendamento = $this->agendamentosRepository->create(array_add($atributos, 'cliente_id', $clienteId));

		if ($agendamento->cliente->email)
			$this->notificarCliente(
				$agendamento,
				getMessage('information', 1),
				'emails.agendamentos.cliente.cadastro'
			);

		$this->notificarInteressados(
			$agendamento,
			getMessage('information', 2),
			'emails.agendamentos.interessados.cadastro'
		);

		return $agendamento;
	}

	public function cadastrarMultiplosAgendamento($agendamentos) {
		$result = Agendamento::insert($agendamentos);

		if($result) {

			$cliente = $this->usersService->getUser($agendamentos[0]['cliente_id']);

			if ($cliente->email)
				$this->notificarClienteAgendamento(
					$cliente,
					$agendamentos,
					getMessage('information', 1),
					'emails.agendamentos.cliente.notificacao'
				);

		}

		return $result;
	}

	private function notificarClienteAgendamento($cliente, $agendamentos, $subject, $view) {
		Mail::send($view,
			['cliente' => $cliente, 'agendamentos' => $agendamentos],
			function ($message) use ($cliente, $agendamentos, $subject) {

				return $message
					->to($cliente->email)
					->subject($subject);
			}
		);
	}

	public function cancelarAgendamento($clienteId, $agendamentoId) {
		$agendamento = Agendamento::where('cliente_id', $clienteId)
			->where('id', $agendamentoId)
			->whereNull('data_cancelamento')
			->firstOrFail();
		$agendamento->data_cancelamento = Carbon::now();
		return $agendamento->save();
	}

	public function minhaAgenda($start, $end, $profissionalId = null) {
		$query = DB::table('agendamentos')->select(DB::raw(
			'agendamentos.id as "id",' .
			' upper(concat(users.name, " - ", servicos.descricao)) as "title",' .
			' concat(agendamentos.data, "T", agendamentos.hora) as "start",' .
			' concat(agendamentos.data, "T", addtime(agendamentos.hora, servicos.duracao)) as "end"'
		))->join('users', 'users.id', '=', 'agendamentos.cliente_id')
			->join('servicos', 'servicos.id', '=', 'agendamentos.servico_id')
			->whereNull('agendamentos.data_cancelamento')
			->where('agendamentos.status', Agendamento::CONFIRMADO)
			->whereBetween('agendamentos.data', [$start, $end]);

		if ($profissionalId)
			$query = $query->where('profissional_id', $profissionalId);

		return $query->get();
	}

	public function meusAgendamentosPendentes($start, $end = null, $profissionalId = null) {
		$query = Agendamento::orderBy('data')
			->where('status', Agendamento::INDETERMINADO)
			->whereNull('data_cancelamento')
			->where('data', '>=', $start);

		if ($end)
			$query = $query->where('data', '<=', $end);

		if ($profissionalId)
			$query = $query->where('profissional_id', $profissionalId);

		return $query->get();
	}

	public function analisar($agendamentoId, $status, $justificativa = null) {
		$agendamento = Agendamento::findOrFail($agendamentoId);
		$agendamento->status = $status;
		$agendamento->justificativa = $justificativa;
		$agendamento->save();

		if ($agendamento->cliente->email)
			$this->notificarCliente(
				$agendamento,
				getMessage('information', 3, [Agendamento::getStatusName($agendamento->status)]),
				'emails.agendamentos.cliente.analise'
			);

		return $agendamento;
	}

	public function agendaDoDia($dia, $profissionalId = null) {
		$query = Agendamento::orderBy('hora')
			->where('status', Agendamento::CONFIRMADO)
			->whereNull('data_cancelamento')
			->where('data', $dia);

		if ($profissionalId)
			$query = $query->where('profissional_id', $profissionalId);

		return $query->get();
	}

	public function getAgendamento($id) {
		return $this->agendamentosRepository->find($id);
	}

	private function notificarCliente(Agendamento $agendamento, $subject, $view) {
		Mail::send($view,
			['agendamento' => $agendamento],
			function ($message) use ($agendamento, $subject) {
				return $message
					->to($agendamento->cliente->email)
					->subject($subject);
			}
		);
	}

	private function notificarInteressados(Agendamento $agendamento, $subject, $view) {
		$interessados = $this->usersService->getInteressadosAgendamento($agendamento);
		$emails = $this->usersService->getUsersEmail($interessados);
		Mail::send($view,
			['agendamento' => $agendamento],
			function ($message) use ($emails, $subject) {
				return $message
					->to($emails)
					->subject($subject);
			}
		);
	}

}
