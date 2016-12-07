<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\Repository;
use App\Services\AgendamentosServiceInterface;
use App\Services\CategoriasServicosServiceInterface;

use App\Http\Requests\AgendamentoRequest;
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

}
