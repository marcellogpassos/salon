<?php

namespace App\Http\Controllers;

use App\Services\AgendamentosServiceInterface;
use App\Services\CategoriasServicosServiceInterface;

use App\Http\Requests\AgendamentoRequest;
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
        return view('agendamentos.index')
            ->with('categoriasServicos', $categoriasServicos)
            ->with('agendamentos', $user->agendamentos);
    }

    public function agendar(AgendamentoRequest $request) {
        $cliente = Auth::user();;
        $this->agendamentosService->cadastrarAgendamento($cliente->id, $request->all());
        showMessage('success', 12);
        return redirect('/agendamentos');
    }

}
