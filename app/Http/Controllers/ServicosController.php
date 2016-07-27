<?php

namespace App\Http\Controllers;

use App\CategoriasServicos;
use App\Services\ServicoServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;

class ServicosController extends Controller {

	protected $servicosService;

	public function __construct(ServicoServiceInterface $service) {
		$this->servicosService = $service;
		$this->middleware('auth');
	}

	public function mostrarFormCadastrarServico() {
		return view('servicos.cadastrar')
			->with('categoriasServicos', CategoriasServicos::all());
	}

	public function cadastrarServico(Request $request) {
		dd($request->all());
		$servicoAttr = $request->only('descricao', 'categoria_id', 'masculino', 'feminino');
		$itemVendaAttr = $request->only('id', 'ativo', 'valor');
		$servico = false;
		try {
			$servico = $this->servicosService->cadastrar($servicoAttr, $itemVendaAttr);
		} catch (QueryException $ex) {
		}
		$servico ? showMessage('success', 8, [$servico->descricao]) : showMessage('error', 6, [$servicoAttr['descricao']]);
		return Redirect::to('/servicos/buscar?id=' . $servico->id);
	}

}
