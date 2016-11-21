<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 26/10/2016
 * Time: 10:41
 */

namespace App\Services;


interface EstatisticasServiceInterface {

	public function clientesMaisRentaveis($limit = null);

	public function clientesMaisFrequentes($limit = null);

	public function produtosMaisVendidos($limit = null);

	public function servicosMaisVendidos($limit = null);

	public function movimentoSemanal();

	public function movimentoMensal();

	public function movimentoAnual();

	public function clientesPorSexo();

	public function clientesPorFaixaEtaria();

	public function clientesPorBairro($limit = null);

	public function vendas();

	public function receita();

	public function novosClientes();

	public function servicosVendidos();

	public function produtosVendidos();

}