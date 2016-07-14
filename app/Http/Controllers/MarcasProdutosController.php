<?php

namespace App\Http\Controllers;

use App\MarcasProdutos;
use App\Services\MarcasProdutosServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests\MarcasProdutosRequest;
use Illuminate\Support\Facades\Redirect;

class MarcasProdutosController extends Controller {

    protected $marcasService;

    public function __construct(MarcasProdutosServiceInterface $service) {
        $this->marcasService = $service;
        $this->middleware('auth');
    }

    public function mostrarListaMarcasProdutos() {
        $marcas = $this->marcasService->listarTodasOrdenarPorDescricao();
        return view('marcas.listar')
            ->with('marcas', $marcas);
    }

    public function mostrarFormCadastrarMarcaProduto() {
        return view('marcas.cadastrar');
    }

    public function mostrarFormEditarMarcaProduto($id) {
        $marca = $this->marcasService->getById($id);
        return view('marcas.editar')
            ->with('marca', $marca);
    }

    public function cadastrarMarcaProduto(MarcasProdutosRequest $request) {
        $marca = $this->marcasService->cadastrar($request->all());
        showMessage('success', 2, [$marca->descricao]);
        return Redirect::to('/marcas');
    }

    public function editarMarcaProduto($id, MarcasProdutosRequest $request) {
        $nomeMarca = $this->marcasService->getById($id)->descricao;
        if ($this->marcasService->atualizar($id, $request->all()))
            showMessage('success', 4, [$nomeMarca]);
        else
            showMessage('error', 2, [$nomeMarca]);
        return Redirect::to('/marcas');
    }

    public function excluirMarcaProduto($id, Request $request) {
        $marca = $this->marcasService->getById($id);
        $result = false;
        try {
            $result = $this->marcasService->deletar($id);
        } catch (QueryException $ex) {
        }
        $result ? showMessage('success', 3, [$marca->descricao]) : showMessage('error', 0, [$marca->descricao]);
        return Redirect::to('/marcas');
    }

}
