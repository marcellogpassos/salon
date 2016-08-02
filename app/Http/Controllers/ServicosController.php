<?php

namespace App\Http\Controllers;

use App\CategoriasServicos;
use App\Http\Requests\ServicosRequest;
use App\Services\CategoriasServicosServiceInterface;
use App\Services\ServicoServiceInterface;
use App\Services\UsersServiceInterface;
use Illuminate\Support\Facades\Redirect;

class ServicosController extends Controller {

    protected $servicosService;
    protected $categoriasServicosService;
    protected $usersService;

    public function __construct(ServicoServiceInterface $service, UsersServiceInterface $usersService,
                                CategoriasServicosServiceInterface $categoriasServicosService) {
        $this->servicosService = $service;
        $this->usersService = $usersService;
        $this->categoriasServicosService = $categoriasServicosService;
        $this->middleware('auth');
    }

    public function mostrarServicosEncontrados() {
        return view('servicos.listar');
    }

    public function mostrarFormCadastrarServico() {
        return view('servicos.cadastrar')
            ->with('categoriasServicos', $this->categoriasServicosService->listarTodos())
            ->with('funcionarios', $this->usersService->listarFuncionarios());
    }

    public function cadastrarServico(ServicosRequest $request) {
        $servicoAttr = $request->only('descricao', 'categoria_id', 'masculino', 'feminino');
        $itemVendaAttr = $request->only('id', 'ativo', 'valor');
        $funcionariosHabilitadosAttr = $request->input('funcionarios');
        $servico = false;
        try {
            $servico = $this->servicosService->cadastrar($servicoAttr, $itemVendaAttr);
        } catch (QueryException $ex) {
        }
        if ($servico) {
            showMessage('success', 8, [$servico->descricao]);
            $this->servicosService->definirFuncionariosHabilitados($servico->id, $funcionariosHabilitadosAttr);
        } else
            showMessage('error', 6, [$servicoAttr['descricao']]);
        return Redirect::to('/servicos/buscar?id=' . $servico->id);
    }

}
