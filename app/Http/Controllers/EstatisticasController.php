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
		];

		dd($this->estatisticasService->clientesPorBairro(true));

		return view('estatisticas.estatisticas')
			->with('clientesPorSexo', $this->estatisticasService->clientesPorSexo())
			->with('clientesPorFaixaEtaria', $this->estatisticasService->clientesPorFaixaEtaria())
			->with('clientesPorBairro', $this->estatisticasService->clientesPorBairro(true))
			->with('movimentoSemanal', $this->estatisticasService->movimentoSemanal())
			->with('movimentoMensal', $this->estatisticasService->movimentoMensal())
			->with('produtosMaisVendidos', $this->estatisticasService->produtosMaisVendidos(true))
			->with('servicosMaisVendidos', $this->estatisticasService->servicosMaisVendidos(true));
	}

}
