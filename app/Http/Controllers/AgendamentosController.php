<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\Repository;
use App\Services\AgendamentosServiceInterface;
use App\Services\CategoriasServicosServiceInterface;

use App\Http\Requests\AgendamentoRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentosController extends Controller {

    protected $categoriasServicosService;

    protected $agendamentosService;

    public function __construct(CategoriasServicosServiceInterface $categoriasServicosService,
                                AgendamentosServiceInterface $agendamentosService) {
        $this->categoriasServicosService = $categoriasServicosService;
        $this->agendamentosService = $agendamentosService;
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
        $agendamento = $this->agendamentosService->cadastrarAgendamento($cliente->id, $request->all());
        showMessage('success', 12);
        return redirect('/agendamentos');
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

}
