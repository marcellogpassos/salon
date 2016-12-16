<?php

namespace App\Http\Controllers;

use App\CategoriasServicos;
use App\Http\Requests\ServicosBuscarRequest;
use App\Http\Requests\ServicosRequest;
use App\Services\CategoriasServicosServiceInterface;
use App\Services\ServicoServiceInterface;
use App\Services\UsersServiceInterface;
use App\Servico;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function listarServicosPorCategoria($id) {
        $categorias = DB::table('servicos')
            ->join('itens_venda', 'servicos.id', '=', 'itens_venda.id')
            ->where('itens_venda.ativo', true)
            ->where('servicos.categoria_id', $id)
            ->select('servicos.*', 'itens_venda.ativo', 'itens_venda.valor')
            ->get();
        return response()->json($categorias);
    }

    public function listarProfissionaisPorServico($id) {
        $profissionais = DB::table('users')
            ->join('servico_user', 'servico_user.user_id', '=', 'users.id')
            ->where('servico_user.servico_id', $id)
            ->select('users.id', 'users.name', 'users.surname')
            ->get();
        return response()->json($profissionais);
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
        $servicoAttr = $request->only('descricao', 'categoria_id', 'masculino', 'feminino', 'duracao');
        $itemVendaAttr = $request->only('ativo', 'valor');
        $itemVenda = false;

        try {
            $itemVenda = $this->servicosService->editar($id, $servicoAttr, $itemVendaAttr);
        } catch (QueryException $ex) {
        }

        if ($itemVenda && $request->has('funcionarios'))
            $this->servicosService->definirFuncionariosHabilitados($itemVenda->id, $request->input('funcionarios'));

        if ($itemVenda)
            showMessage('success', 9, [$itemVenda->servico->descricao]);
        else
            showMessage('error', 7, [$servicoAttr['descricao']]);

        return Redirect::to('/servicos/buscar?id=' . $itemVenda->id);
    }

    public function excluirServico($id) {
        $servico = $this->servicosService->getById($id);
        $result = false;
        try {
            $result = $this->servicosService->deletar($id);
        } catch (QueryException $ex) {
        }
        $result ? showMessage('success', 10, [$servico->descricao]) : showMessage('error', 8, [$servico->descricao]);
        return Redirect::to('/servicos/buscar');
    }

}
