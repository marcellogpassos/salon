<?php

namespace App\Http\Controllers;

use App\Services\CategoriasServicosServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;

class AgendamentosController extends Controller {

    protected $categoriasServicosService;

    public function __construct(CategoriasServicosServiceInterface $categoriasServicosService) {
        $this->categoriasServicosService = $categoriasServicosService;
        $this->middleware('auth');
    }

    public function index() {
        return view('agendamentos.index')
            ->with('categoriasServicos', $this->categoriasServicosService->listarTodos());
    }

}
