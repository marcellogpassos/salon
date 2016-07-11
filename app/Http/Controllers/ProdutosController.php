<?php

namespace App\Http\Controllers;

use App\CategoriasProdutos;
use App\MarcasProdutos;
use App\Produto;
use App\Repositories\CategoriasProdutosRepository;
use App\Services\CategoriasProdutosService;
use App\Services\CategoriasProdutosServiceInterface;
use App\Services\MarcasProdutosService;
use App\Services\MarcasProdutosServiceInterface;
use App\Services\ProdutosServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests\ProdutosBuscarRequest;

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

    public function mostrarFormBuscarProdutos() {
        $produtos = $this->produtosService->listarTodasOrdenarPorDescricao();
        return view('produtos.listar')
            ->with('produtosEncontrados', $produtos)
            ->with('categoriasProdutos', $this->categoriasProdutosService->listarTodasOrdenarPorDescricao())
            ->with('marcasProdutos', $this->marcasProdutosService->listarTodasOrdenarPorDescricao());
    }

    public function mostrarProdutosEncontrados(ProdutosBuscarRequest $request) {
        $produtos = $this->produtosService->buscar($request->all());
    }

}
