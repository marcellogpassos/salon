<?php

namespace App\Http\Controllers;

use App\CategoriasProdutos;
use App\MarcasProdutos;
use App\Produto;
use App\Services\ProdutosServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProdutosController extends Controller {

    protected $produtosService;

    public function __construct(ProdutosServiceInterface $service) {
        $this->produtosService = $service;
        $this->middleware('auth');
    }

    public function mostrarListaProdutos() {
        $produtos = $this->produtosService->listarTodasOrdenarPorDescricao();

        return view('produtos.listar')
            ->with('produtosEncontrados', $produtos)
            ->with('categoriasProdutos', CategoriasProdutos::all())
            ->with('marcasProdutos', MarcasProdutos::all());
    }

}
