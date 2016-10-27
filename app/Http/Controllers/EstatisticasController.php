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
		return $this->estatisticasService->clientesPorFaixaEtaria();
	}

}
