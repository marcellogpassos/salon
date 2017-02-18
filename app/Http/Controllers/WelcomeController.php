<?php

namespace App\Http\Controllers;

use App\Services\AgendamentosServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller {

	protected $agendamentosService;

	public function __construct(AgendamentosServiceInterface $agendamentosService) {
		$this->agendamentosService = $agendamentosService;
	}

	// @auth
	public function welcome() {
		if (Auth::guest())
			return redirect('/index');

		$user = Auth::user();

		if(!$user->dados_atualizados)
			return redirect()->action('UsersController@mostrarFormEditarDadosUsuario');

		if(!count($user->roles))
			return redirect('/agendamentos');

		$hoje = Carbon::today();

		$agendamentosPedentes = ($user->admin()) ?
			$this->agendamentosService->meusAgendamentosPendentes($hoje->toDateString()) :
			$this->agendamentosService->meusAgendamentosPendentes($hoje->toDateString(), null, $user->id);

		$agendaDoDia = ($user->admin()) ?
			$this->agendamentosService->agendaDoDia($hoje->toDateString()) :
			$this->agendamentosService->agendaDoDia($hoje->toDateString(), $user->id);

		return view('welcome')
			->with('agendamentos', $agendamentosPedentes)
			->with('agendaDoDia', $agendaDoDia);
	}

}
