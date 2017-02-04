<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 04/10/2016
 * Time: 17:47
 */

namespace App\Services;


use App\Compra;
use App\Repositories\ComprasRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ComprasService implements ComprasServiceInterface {

	protected $comprasRepository;

	protected $bandeirasCartoesService;
	protected $formasPagamentoService;
	protected $itensVendaService;
	protected $produtosService;
	protected $usersService;

	public function __construct(UsersServiceInterface $usersService, ItensVendaServiceInterface $itensVendaService,
								FormasPagamentoServiceInterface $formasPagamentoService, ComprasRepository $repository,
								BandeirasCartoesServiceInterface $bandeirasCartoesService, ProdutosServiceInterface $produtosService) {
		$this->bandeirasCartoesService = $bandeirasCartoesService;
		$this->formasPagamentoService = $formasPagamentoService;
		$this->itensVendaService = $itensVendaService;
		$this->produtosService = $produtosService;
		$this->usersService = $usersService;

		$this->comprasRepository = $repository;
	}

	public function buscar($criterios) {
		return $this->comprasRepository->buscar($criterios);
	}

	public function cadastrar(array $compra) {
		if (!$compra)
			abort(400);
		$itensCompra = array_pull($compra, 'itens_compra');
		$novaCompra = null;
		DB::beginTransaction();
		try {
			foreach ($itensCompra as $itemCompra) {
				$produto = $this->produtosService->buscarPeloId($itemCompra['item_id']);
				if (isset($produto))
					$this->produtosService->decrementarQuantidade($produto, $itemCompra['quantidade']);
			}
			$novaCompra = $this->comprasRepository->createAndPersistItens($compra, $itensCompra);
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
		}
		DB::commit();
		return $novaCompra;
	}

	public function criarCompra($caixaId, array $attributes, $clienteId = null) {
		$formaPagamento = $this->formasPagamentoService->getFormaPagamento($attributes['formaPagamento']);
		$bandeiraCartao = $formaPagamento->pede_bandeira_cartao ?
			$this->bandeirasCartoesService->getBandeiraCartao($attributes['bandeiraCartao']) : null;

		$compra['data_compra'] = date('Y-m-d H:i:s');
		if ($clienteId)
			$compra['cliente_id'] = $clienteId;
		$compra['caixa_id'] = $caixaId;
		$compra['itens_compra'] = $this->getItensCompra($attributes['itens']);
		$compra['valor_total'] = $this->calcularValorTotal($compra['itens_compra']);
		$compra['desconto'] = (float)$attributes['desconto'];
		$compra['forma_pagamento_id'] = $formaPagamento->id;
		if ($bandeiraCartao)
			$compra['bandeira_cartao_id'] = $bandeiraCartao->id;
		$compra['codigo_validacao'] = $this->gerarCodigoValidacao($compra);

		return $compra;
	}

	private function calcularValorTotal(array $itensCompra) {
		$valorTotal = 0;
		foreach ($itensCompra as $item)
			$valorTotal += $item['quantidade'] * $item['valor_unitario_corrente'];
		return $valorTotal;
	}

	private function getItensCompra(array $itensArray) {
		$itensCompra = [];
		foreach ($itensArray as $item) {
			$itemEncontrado = $this->itensVendaService->getItemVenda($item['id']);
			$itemCompra = [
				'item_id' => $itemEncontrado->id,
				'quantidade' => (int)$item['quantidade'],
				'valor_unitario_corrente' => $itemEncontrado->valor,
			];
			array_push($itensCompra, $itemCompra);
		}
		return $itensCompra;
	}

	public function gerarCodigoValidacao($compra) {
		$md5 = md5($compra['data_compra']);
		$base64 = base64_encode(pack('H*', $md5));
		$base64clean = str_replace('+', '', str_replace('/', '', $base64));
		$code = strtoupper(substr($base64clean, 0, 6));
		return $code;
	}

	public function getByCodigoValidacao($codigoValidacao) {
		$compra = $this->comprasRepository->findBy('codigo_validacao', $codigoValidacao);
		return $compra;
	}

	public function cancelarCompra($compra) {
		$dataCancelamento = Carbon::now();
		return $this->comprasRepository->update(['data_cancelamento' => $dataCancelamento], $compra->id);
	}

}