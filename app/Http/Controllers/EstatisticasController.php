<?php

namespace App\Http\Controllers;

use App\Services\EstatisticasServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;

class EstatisticasController extends Controller {

	protected $estatisticasService;

	public function __construct(EstatisticasServiceInterface $serviceInterface) {
		$this->estatisticasService = $serviceInterface;
	}

	public function mostrarEstatisticas() {
		$estatisticas = [
			'clientesMaisRentaveis' => $this->estatisticasService->clientesMaisRentaveis(),
			'clientesMaisFrequentes' => $this->estatisticasService->clientesMaisFrequentes(),
			'produtosMaisVendidos' => $this->estatisticasService->produtosMaisVendidos(),
			'servicosMaisVendidos' => $this->estatisticasService->servicosMaisVendidos(),
			'movimentoMensal' => $this->estatisticasService->movimentoMensal(),
			'movimentoAnual' => $this->estatisticasService->movimentoAnual(),
			'clientesPorBairro' => $this->estatisticasService->clientesPorBairro(),
		];

//		dd($this->estatisticasService->movimentoSemanal());

		return view('estatisticas.estatisticas')
			->with('clientesPorSexo', $this->estatisticasService->clientesPorSexo())
			->with('clientesPorFaixaEtaria', $this->estatisticasService->clientesPorFaixaEtaria())
			->with('movimentoSemanal', $this->estatisticasService->movimentoSemanal());
	}

}
