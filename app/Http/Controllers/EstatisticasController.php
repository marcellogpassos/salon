<?php

namespace App\Http\Controllers;

use App\Services\EstatisticasServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class EstatisticasController extends Controller {

	protected $estatisticasService;

	public function __construct(EstatisticasServiceInterface $serviceInterface) {
		$this->estatisticasService = $serviceInterface;
		$this->middleware('auth');
		$this->middleware('admin');
	}

	// @auth @admin
	public function mostrarEstatisticas() {
		return view('estatisticas.estatisticas')
			->with('clientesMaisRentaveis', $this->estatisticasService->clientesMaisRentaveis())
			->with('clientesMaisFrequentes', $this->estatisticasService->clientesMaisFrequentes())
			->with('clientesPorSexo', $this->estatisticasService->clientesPorSexo())
			->with('clientesPorFaixaEtaria', $this->estatisticasService->clientesPorFaixaEtaria())
			->with('clientesPorBairro', $this->estatisticasService->clientesPorBairro(true))
			->with('movimentoSemanal', $this->estatisticasService->movimentoSemanal())
			->with('movimentoMensal', $this->estatisticasService->movimentoMensal())
			->with('produtosMaisVendidos', $this->estatisticasService->produtosMaisVendidos(true))
			->with('servicosMaisVendidos', $this->estatisticasService->servicosMaisVendidos(true))
			->with('vendas', $this->estatisticasService->vendas())
			->with('receita', $this->estatisticasService->receita())
			->with('novosClientes', $this->estatisticasService->novosClientes())
			->with('servicosVendidos', $this->estatisticasService->servicosVendidos())
			->with('produtosVendidos', $this->estatisticasService->produtosVendidos());
	}

}
