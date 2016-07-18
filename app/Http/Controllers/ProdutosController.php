<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutosCadastrarRequest;
use App\Repositories\CategoriasProdutosRepository;
use App\Repositories\Criteria\BuscarPorDescricao;
use App\Repositories\ProdutoRepository;
use App\Repositories\ProdutosRepository;
use App\Services\CategoriasProdutosServiceInterface;
use App\Services\MarcasProdutosServiceInterface;
use App\Services\ProdutosServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests\ProdutosBuscarRequest;
use Illuminate\Support\Facades\Redirect;

class ProdutosController extends Controller {

    protected $produtosService;
    protected $marcasProdutosService;
    protected $categoriasProdutosService;

    public function __construct(ProdutosServiceInterface $service, MarcasProdutosServiceInterface $marcasProdutosService,
                                CategoriasProdutosServiceInterface $categoriasProdutosService) {
        $this->produtosService = $service;
        $this->marcasProdutosService = $marcasProdutosService;
        $this->categoriasProdutosService = $categoriasProdutosService;
        $this->middleware('auth');
    }

    public function mostrarProdutosEncontrados(ProdutosBuscarRequest $request) {
        if (buscaPadrao($request->all())) {
            $produtos = $this->produtosService->listarTodasOrdenarPorDescricao();
            return $this->returnViewProdutosListar($produtos);
        } else {
            $produtos = $this->produtosService->buscar($request->all());
            return $this->returnViewProdutosListar($produtos, $request->all());
        }
    }

    public function returnViewProdutosListar($produtos, $buscaPrevia = null) {
        return view('produtos.listar')
            ->with('produtosEncontrados', $produtos)
            ->with('buscaPrevia', $buscaPrevia)
            ->with('categoriasProdutos', $this->categoriasProdutosService->listarTodos())
            ->with('marcasProdutos', $this->marcasProdutosService->listarTodasOrdenarPorDescricao());
    }

    public function excluirProduto($id, Request $request) {
        $produto = $this->produtosService->getById($id);
        $result = false;
        try {
            $result = $this->produtosService->deletar($id);
        } catch (QueryException $ex) {
        }
        $result ? showMessage('success', 5, [$produto->descricao]) : showMessage('error', 1, [$produto->descricao]);
        return Redirect::to('/produtos/buscar');
    }

    public function mostrarFormCadastrarProduto() {
        return view('produtos.cadastrar')
            ->with('categoriasProdutos', $this->categoriasProdutosService->listarTodos())
            ->with('marcasProdutos', $this->marcasProdutosService->listarTodasOrdenarPorDescricao());
    }

    public function cadastrarProduto(ProdutosCadastrarRequest $request) {
        dd($request->all());
    }

}
