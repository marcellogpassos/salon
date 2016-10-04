<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 04/10/2016
 * Time: 17:47
 */

namespace App\Services;


use App\Repositories\ComprasRepository;

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

    public function cadastrar(array $attributes) {
        if (!$attributes)
            abort(400);
        return $this->comprasRepository->create($attributes);
    }

    public function criarCompra($clienteId, $caixaId, array $attributes) {
        $cliente = $this->usersService->getUser($clienteId);
        $formaPagamento = $this->formasPagamentoService->getFormaPagamento($attributes['formaPagamento']);
        $bandeiraCartao = $formaPagamento->pede_bandeira_cartao ?
            $this->bandeirasCartoesService->getBandeiraCartao($attributes['bandeiraCartao']) : null;

        $compra['data_compra'] = date('Y-m-d H:i:s');
        $compra['cliente_id'] = $cliente->id;
        $compra['caixa_id'] = $caixaId;
        $compra['valor_total'] = $this->calcularValorTotal($attributes['itens']);
        $compra['desconto'] = (float)$attributes['desconto'];
        $compra['forma_pagamento_id'] = $formaPagamento->id;
        if ($bandeiraCartao)
            $compra['bandeira_cartao_id'] = $bandeiraCartao->id;
        $compra['codigo_validacao'] = $this->gerarCodigoValidacao($compra);

        return $compra;
    }

    private function calcularValorTotal($itens) {
        $valorTotal = 0;
        foreach ($itens as $item) {
            $itemEncontrado = $this->itensVendaService->getItemVenda($item['id']);
            $valorTotal += $itemEncontrado->valor * ((int)$item['quantidade']);
        }
        return $valorTotal;
    }

    public function gerarCodigoValidacao($compra) {
        return strtoupper(substr(md5($compra['data_compra']), 0, 6));
    }
}