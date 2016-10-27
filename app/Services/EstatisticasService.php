<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 26/10/2016
 * Time: 10:40
 */

namespace App\Services;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class EstatisticasService implements EstatisticasServiceInterface {

	public function clientesMaisRentaveis() {
		$query = Config::get('queries.clientesMaisRentaveis');
		$result = DB::select($query);
		return response()->json($result);
	}

	public function clientesMaisFrequentes() {
		$query = Config::get('queries.clientesMaisFrequentes');
		$result = DB::select($query);
		return response()->json($result);
	}

	public function produtosMaisVendidos() {
		$query = Config::get('queries.produtosMaisVendidos');
		$result = DB::select($query);
		return response()->json($result);
	}

	public function servicosMaisVendidos() {
		$query = Config::get('queries.servicosMaisVendidos');
		$result = DB::select($query);
		return response()->json($result);
	}

	public function movimentoSemanal() {
		$query = Config::get('queries.movimentoSemanal');
		$result = DB::select($query);
		return response()->json($result);
	}

	public function movimentoMensal() {
		$query = Config::get('queries.movimentoMensal');
		$result = DB::select($query);
		return response()->json($result);
	}

	public function movimentoAnual() {
		// TODO: Implement movimentoAnual() method.
	}

	public function clientesPorSexo() {
		$query = Config::get('queries.clientesPorSexo');
		$result = DB::select($query);
		return response()->json($result);
	}

	public function clientesPorFaixaEtaria() {
		$query = Config::get('queries.clientesPorFaixaEtaria');
		$faixasEtarias = [];
		$faixaAnos = 7;
		$faixaQuantidade = 7;
		for ($i = 0; $i <= $faixaQuantidade; $i++) {
			$faixaLabel = 'de ' . ($i * $faixaAnos) . ' a ' . (($i + 1) * $faixaAnos) . ' anos';
			$faixaQuantidade = DB::select($query, [($i * $faixaAnos), (($i + 1) * $faixaAnos)])[0]->quantidade;
			array_add($faixasEtarias, $faixaLabel, $faixaQuantidade);
		}
		return response()->json($faixasEtarias);
	}

	public function clientesPorBairro() {
		// TODO: Implement clientesPorBairro() method.
	}
}