<?php

namespace App\Http\Controllers;

use App\MarcasProdutos;
use Illuminate\Http\Request;

use App\Http\Requests;

class MarcasProdutosController extends Controller {

    public function mostrarListaMarcasProdutos() {
        $marcas = MarcasProdutos::orderBy('descricao')->get();
        return view('marcas.listar')
            ->with('marcas', $marcas);
    }

}
