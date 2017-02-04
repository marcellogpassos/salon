<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutosRequest;
use App\Produto;
use App\Repositories\CategoriasProdutosRepository;
use App\Repositories\Criteria\BuscarPorDescricao;
use App\Repositories\ProdutoRepository;
use App\Repositories\ProdutosRepository;
use App\Services\CategoriasProdutosServiceInterface;
use App\Services\MarcasProdutosServiceInterface;
use App\Services\ProdutosServiceInterface;
use Illuminate\Database\QueryException;
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
		$this->middleware('admin', ['only' => [
			'mostrarFormCadastrarProduto', 'cadastrarProduto', 'mostrarFormEditarProduto', 'editarProduto', 'excluirProduto'
		]]);
		$this->middleware('professional', ['only' => [
			'mostrarProdutosEncontrados', 'returnViewProdutosListar'
		]]);
	}

	// @auth @professional
	public function mostrarProdutosEncontrados(ProdutosBuscarRequest $request) {
		if (buscaPadrao($request->all())) {
			$produtos = $this->produtosService->listarTodasOrdenarPorDescricao();
			return $this->returnViewProdutosListar($produtos);
		} else {
			$produtos = $this->produtosService->buscar($request->all());
			return $this->returnViewProdutosListar($produtos, $request->all());
		}
	}

	// @auth @professional
	public function returnViewProdutosListar($produtos, $buscaPrevia = null) {
		return view('produtos.listar')
			->with('produtosEncontrados', $produtos)
			->with('buscaPrevia', $buscaPrevia)
			->with('categoriasProdutos', $this->categoriasProdutosService->listarTodos())
			->with('marcasProdutos', $this->marcasProdutosService->listarTodasOrdenarPorDescricao());
	}

	// @auth @admin
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

	// @auth @admin
	public function mostrarFormCadastrarProduto() {
		return view('produtos.cadastrar')
			->with('categoriasProdutos', $this->categoriasProdutosService->listarTodos())
			->with('marcasProdutos', $this->marcasProdutosService->listarTodasOrdenarPorDescricao());
	}

	// @auth @admin
	public function cadastrarProduto(ProdutosRequest $request) {
		$produtoAttr = $request->only('descricao', 'categoria_id', 'marca_id', 'quantidade', 'codigo_barras');
		$itemVendaAttr = $request->only('id', 'ativo', 'valor');
		$produto = false;
		try {
			$produto = $this->produtosService->cadastrar($produtoAttr, $itemVendaAttr);
		} catch (QueryException $ex) {
		}
		$produto ? showMessage('success', 6, [$produto->descricao]) : showMessage('error', 4, [$produtoAttr['descricao']]);
		return Redirect::to('/produtos/buscar?id=' . $produto->id);
	}

	// @auth @admin
	public function mostrarFormEditarProduto($id) {
		$produto = $this->produtosService->getById($id);
		return view('produtos.editar')
			->with('produto', $produto)
			->with('categoriasProdutos', $this->categoriasProdutosService->listarTodos())
			->with('marcasProdutos', $this->marcasProdutosService->listarTodasOrdenarPorDescricao());
	}

	// @auth @admin
	public function editarProduto($id, ProdutosRequest $request) {
		$produtoAttr = $request->only('descricao', 'categoria_id', 'marca_id', 'quantidade', 'codigo_barras');
		$itemVendaAttr = $request->only('ativo', 'valor');
		$itemVenda = false;
		try {
			$itemVenda = $this->produtosService->editar($id, $produtoAttr, $itemVendaAttr);
		} catch (QueryException $ex) {
		}
		$itemVenda ? showMessage('success', 7, [$itemVenda->produto->descricao]) : showMessage('error', 5, [$produtoAttr['descricao']]);
		return Redirect::to('/produtos/buscar?id=' . $itemVenda->id);
	}

}
