<?php

namespace App\Http\Controllers;

use App\MarcasProdutos;
use App\Services\MarcasProdutosServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;

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

}
