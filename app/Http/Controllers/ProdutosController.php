<?php

namespace App\Http\Controllers;

use App\CategoriasProdutos;
use App\MarcasProdutos;
use App\Produto;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProdutosController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function mostrarListaProdutos() {
        return view('produtos.listar')
            ->with('produtosEncontrados', Produto::all())
            ->with('categoriasProdutos', CategoriasProdutos::all())
            ->with('marcasProdutos', MarcasProdutos::all());
    }

}
