<?php

namespace App\Http\Controllers;

use App\Services\AgendamentosServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class WellcomeController extends Controller {

	protected $agendamentosService;

	public function __construct(AgendamentosServiceInterface $agendamentosService) {
		$this->agendamentosService = $agendamentosService;
		$this->middleware('auth');
	}

	public function wellcome() {
		$user = Auth::user();

		if (!$user)
			return view('welcome');

		$hoje = Carbon::today();

		$agendamentosPedentes = ($user->admin()) ?
			$this->agendamentosService->meusAgendamentosPendentes($hoje->toDateString()) :
			$this->agendamentosService->meusAgendamentosPendentes($hoje->toDateString(), null, $user->id);

		return view('welcome')
			->with('agendamentos', $agendamentosPedentes);
	}

}
