<?php

namespace App\Http\Controllers;

use App\CategoriasServicos;
use App\Http\Requests\ServicosRequest;
use App\Services\CategoriasServicosServiceInterface;
use App\Services\ServicoServiceInterface;
use Illuminate\Support\Facades\Redirect;

class ServicosController extends Controller {

    protected $servicosService;
    protected $categoriasServicosService;

    public function __construct(ServicoServiceInterface $service, CategoriasServicosServiceInterface $categoriasServicosService) {
        $this->servicosService = $service;
        $this->categoriasServicosService = $categoriasServicosService;
        $this->middleware('auth');
    }

    public function mostrarServicosEncontrados() {
        return view('servicos.listar');
    }

    public function mostrarFormCadastrarServico() {
        return view('servicos.cadastrar')
            ->with('categoriasServicos', $this->categoriasServicosService->listarTodos());
    }

    public function cadastrarServico(ServicosRequest $request) {
        $servicoAttr = $request->only('descricao', 'categoria_id', 'masculino', 'feminino');
        $itemVendaAttr = $request->only('id', 'ativo', 'valor');
        $servico = false;
        try {
            $servico = $this->servicosService->cadastrar($servicoAttr, $itemVendaAttr);
        } catch (QueryException $ex) {
        }
        $servico ? showMessage('success', 8, [$servico->descricao]) : showMessage('error', 6, [$servicoAttr['descricao']]);
        return Redirect::to('/servicos/buscar?id=' . $servico->id);
    }

}
