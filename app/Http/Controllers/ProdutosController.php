<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProdutosController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function mostrarListaProdutos() {
        return view('produtos.listar')
            ->with('produtos', Produto::all());
    }

}
