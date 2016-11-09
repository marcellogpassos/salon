<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 26/10/2016
 * Time: 10:40
 */

namespace App\Services;


use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class EstatisticasService implements EstatisticasServiceInterface {

	protected $faixaEtariaAnos;

	protected $faixaEtariaQuantidade;

	protected $defaultLimit;

	public function __construct() {
		$this->faixaEtariaAnos = env('FAIXA_ETARIA_ANOS');
		$this->faixaEtariaQuantidade = env('FAIXA_ETARIA_QUANTIDADE');
		$this->defaultLimit = env('DEFAULT_LIMIT');
	}

	protected function getResult($queryName, $limit = null) {
		$query = Config::get($queryName);
		$query .= $limit ?
			(($limit === true) ?
				$this->getLimitStatement($this->defaultLimit) :
				$this->getLimitStatement($limit)) : '';
		return DB::select($query);
	}

	public function clientesMaisRentaveis($limit = null) {
		return $this->getResult('queries.clientesMaisRentaveis', $limit);
	}

	public function clientesMaisFrequentes($limit = null) {
		return $this->getResult('queries.clientesMaisFrequentes', $limit);
	}

	public function produtosMaisVendidos($limit = null) {
		return $this->getResult('queries.produtosMaisVendidos', $limit);
	}

	public function servicosMaisVendidos($limit = null) {
		return $this->getResult('queries.servicosMaisVendidos', $limit);
	}

	public function movimentoSemanal() {
		return $this->getResult('queries.movimentoSemanal');
	}

	public function movimentoMensal() {
		return $this->getResult('queries.movimentoMensal');
	}

	public function movimentoAnual() {
		return $this->getResult('queries.movimentoAnual');
	}

	public function clientesPorSexo() {
		return $this->getResult('queries.clientesPorSexo');
	}

	public function clientesPorBairro($limit = null) {
		$bairros = $this->getResult('queries.clientesPorBairro', $limit);
		$notInClause = $this->getNotInClause($bairros);
		$outrosBairrosQuantidade = $this->getGetOutrosBairrosQuantidade($notInClause);
		$outrosBairros = (object)[
			'municipio' => ' - ',
			'bairro' => 'Outros',
			'quantidade' => $outrosBairrosQuantidade
		];
		array_push($bairros, $outrosBairros);
		return $bairros;
	}

	private function getNotInClause($bairros) {
		$notInClause = [];
		for ($i = 0; $i < count($bairros); $i++)
			array_push($notInClause, $bairros[$i]->municipio . $bairros[$i]->bairro);
		return $notInClause;
	}

	private function getGetOutrosBairrosQuantidade($notInClause) {
		return DB::table('users')
			->select(DB::raw('count(*) as quantidade'))
			->whereNotIn(DB::raw('concat(municipio, bairro)'), $notInClause)
			->groupBy(['municipio', 'bairro'])
			->get();
	}

	public function clientesPorFaixaEtaria() {
		$query = Config::get('queries.clientesPorFaixaEtaria');
		$faixasEtarias = [];
		for ($i = 0; $i <= $this->faixaEtariaQuantidade; $i++) {
			$min = $i * $this->faixaEtariaAnos;
			$max = ($i < $this->faixaEtariaQuantidade)
				? ($i + 1) * $this->faixaEtariaAnos : 999;
			$faixaLabel = ($i < $this->faixaEtariaQuantidade)
				? 'DE ' . $min . ' A ' . $max . ' ANOS' : 'MAIS DE ' . $min . ' ANOS';
			$quantidade = DB::select($query, [$min, $max])[0]->quantidade;
			$data = (object)[
				'faixaEtaria' => $faixaLabel,
				'quantidade' => $quantidade
			];
			array_push($faixasEtarias, $data);
		}
		return $faixasEtarias;
	}

	private function getLimitStatement($limit) {
		return ' LIMIT ' . $limit;
	}

}