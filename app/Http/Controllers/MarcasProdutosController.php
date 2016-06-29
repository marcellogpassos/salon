<?php

namespace App\Http\Controllers;

use App\MarcasProdutos;
use App\Services\MarcasProdutosServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests\CadastrarMarcasProdutosRequest;

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

	public function cadastrarMarcaProduto(CadastrarMarcasProdutosRequest $request) {
		$marca = $this->marcasService->cadastrar($request->all());
		showMessage('success', 2, [$marca->descricao]);
		return $this->mostrarListaMarcasProdutos();
	}

	public function excluirMarcaProduto($id, Request $request) {
		$marca = $this->marcasService->getById($id);
		$result = false;
		try{
			$result = $this->marcasService->deletar($id);
		} catch (QueryException $ex) { }
		if($result){
			showMessage('success', 3, [$marca->descricao]);
			return $this->mostrarListaMarcasProdutos();
		} else {
			showMessage('error', 0, [$marca->descricao]);
			return $this->mostrarListaMarcasProdutos();
		}
	}

}
