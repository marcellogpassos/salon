<?php

namespace App\Http\Controllers;

use App\Agendamento;
use App\Repositories\Eloquent\Repository;
use App\Services\AgendamentosServiceInterface;
use App\Services\CategoriasServicosServiceInterface;

use App\Http\Requests\AgendamentoRequest;
use App\Services\UsersServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AgendamentosController extends Controller {

	protected $categoriasServicosService;

	protected $agendamentosService;

	protected $usersService;

	public function __construct(CategoriasServicosServiceInterface $categoriasServicosService,
								AgendamentosServiceInterface $agendamentosService,
								UsersServiceInterface $usersService) {
		$this->categoriasServicosService = $categoriasServicosService;
		$this->agendamentosService = $agendamentosService;
		$this->usersService = $usersService;
		$this->middleware('auth');
	}

	public function index() {
		$user = Auth::user();
		$categoriasServicos = $this->categoriasServicosService->listarTodos();
		$agendamentos = $this->agendamentosService->listarAgendamentosPorUsuario($user->id);
		return view('agendamentos.index')
			->with('categoriasServicos', $categoriasServicos)
			->with('agendamentos', $agendamentos);
	}

	public function agendar(AgendamentoRequest $request) {
		$cliente = Auth::user();

		if (!$this->validarClienteAtivo($cliente))
			return redirect('/home');

		$agendamento = $this->agendamentosService->cadastrarAgendamento($cliente->id, $request->all());

		showMessage('success', 12);
		return redirect('/agendamentos');
	}

	private function validarClienteAtivo($cliente) {
		if ($cliente->ativo)
			return true;
		showMessage('error', 14);
		return false;
	}

	public function cancelarAgendamento($id, Request $request) {
		$cliente = Auth::user();
		$sucesso = $this->agendamentosService->cancelarAgendamento($cliente->id, $id);
		if ($sucesso)
			showMessage('success', 13);
		else
			showMessage('error', 9);
		return redirect('/agendamentos');
	}

	public function minhaAgenda(Request $request) {
		$mesAgenda = new Carbon('first day of this month');
		$current = true;

		if ($request->has('mes'))
			try {
				$mesAgenda = new Carbon($request->input('mes'));
				$current = false;
			} catch (\Exception $ex) {
			}

		$mesAnterior = $mesAgenda->copy()->subMonth();
		$mesSeguinte = $mesAgenda->copy()->addMonth();
		$fimMesAgenda = $mesAgenda->copy()->endOfMonth();

		$agenda = (Auth::user()->admin()) ?
			$this->agendamentosService->minhaAgenda($mesAgenda, $fimMesAgenda) :
			$this->agendamentosService->minhaAgenda($mesAgenda, $fimMesAgenda, Auth::user()->id);

		return view('agendamentos.agenda')
			->with('agenda', $agenda)
			->with('minDate', $mesAgenda->timestamp)
			->with('maxDate', $fimMesAgenda->timestamp)
			->with('mesAnterior', $mesAnterior)
			->with('mesSeguinte', $mesSeguinte)
			->with('default', ($current ? null : $mesAgenda));
	}

	public function agendamentosPendentes() {
		$hoje = Carbon::today();

		$agendamentosPedentes = (Auth::user()->admin()) ?
			$this->agendamentosService->meusAgendamentosPendentes($hoje->toDateString()) :
			$this->agendamentosService->meusAgendamentosPendentes($hoje->toDateString(), null, Auth::user()->id);

		dd($agendamentosPedentes);
	}

	public function analisar(Request $request) {
		$analise = $this->agendamentosService->analisar(
			$request->input('id'),
			$request->input('status'),
			$request->has('justificativa') ? $request->input('justificativa') : null
		);

		if ($analise)
			showMessage('success', 14);
		else
			showMessage('error', 10);

		return Redirect::to('/');
	}

	public function recuperarAgendamento($id) {
		$agendamento = $this->agendamentosService->getAgendamento($id);
		$servico = $agendamento->servico;
		$cliente = $agendamento->cliente;
		$profissional = $agendamento->profissional;
		return response()->json($agendamento);
	}

}
