<?php

namespace App\Http\Controllers;

use App\CategoriasServicos;
use App\Http\Requests\ServicosBuscarRequest;
use App\Http\Requests\ServicosRequest;
use App\Services\CategoriasServicosServiceInterface;
use App\Services\ServicoServiceInterface;
use App\Services\UsersServiceInterface;
use Illuminate\Http\Request;
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

    public function mostrarServicosEncontrados(ServicosBuscarRequest $request) {
        if (buscaPadrao($request->all())) {
            $servicos = $this->servicosService->listarTodasOrdenarPorDescricao();
            return $this->returnViewServicosListar($servicos);
        } else {
            $servicos = $this->servicosService->buscar($request->all());
            return $this->returnViewServicosListar($servicos, $request->all());
        }
    }

    public function returnViewServicosListar($servicos = null, $buscaPrevia = null) {
        return view('servicos.listar')
            ->with('servicosEncontrados', $servicos)
            ->with('buscaPrevia', $buscaPrevia)
            ->with('categoriasServicos', $this->categoriasServicosService->listarTodos());
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

    public function mostrarFormEditarServico($id) {
        $servico = $this->servicosService->getById($id);
        return view('servicos.editar')
            ->with('servico', $servico)
            ->with('categoriasServicos', $this->categoriasServicosService->listarTodos())
            ->with('funcionarios', $this->usersService->listarFuncionarios());
    }

    public function editarServico($id, ServicosRequest $request) {
        dd($request->all());
    }

    public function excluirServico() {

    }

}
