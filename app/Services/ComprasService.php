<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 04/10/2016
 * Time: 17:47
 */

namespace App\Services;


use App\Repositories\ComprasRepository;
use App\Repositories\Criteria\Compra\BuscarPorCodigoValidacao;

class ComprasService implements ComprasServiceInterface {

    protected $comprasRepository;

    protected $bandeirasCartoesService;
    protected $formasPagamentoService;
    protected $itensVendaService;
    protected $usersService;

    public function __construct(UsersServiceInterface $usersService, ItensVendaServiceInterface $itensVendaService,
                                FormasPagamentoServiceInterface $formasPagamentoService, ComprasRepository $repository,
                                BandeirasCartoesServiceInterface $bandeirasCartoesService) {
        $this->bandeirasCartoesService = $bandeirasCartoesService;
        $this->formasPagamentoService = $formasPagamentoService;
        $this->itensVendaService = $itensVendaService;
        $this->usersService = $usersService;

        $this->comprasRepository = $repository;
    }

    public function cadastrar(array $compra) {
        if (!$compra)
            abort(400);
        $itensCompra = array_pull($compra, 'itens_compra');
        return $this->comprasRepository->createAndPersistItens($compra, $itensCompra);
    }

    public function criarCompra($clienteId, $caixaId, array $attributes) {
        $cliente = $this->usersService->getUser($clienteId);
        $formaPagamento = $this->formasPagamentoService->getFormaPagamento($attributes['formaPagamento']);
        $bandeiraCartao = $formaPagamento->pede_bandeira_cartao ?
            $this->bandeirasCartoesService->getBandeiraCartao($attributes['bandeiraCartao']) : null;

        $compra['data_compra'] = date('Y-m-d H:i:s');
        $compra['cliente_id'] = $cliente->id;
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
        return strtoupper(substr(md5($compra['data_compra']), 0, 6));
    }

    public function getByCodigoValidacao($codigoValidacao) {
        $compra = $this->comprasRepository->findBy('codigo_validacao', $codigoValidacao);
        return $compra;
    }
}