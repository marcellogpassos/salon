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
        return response()->json([
            'clientesMaisRentaveis' => $this->estatisticasService->clientesMaisRentaveis(),
            'clientesMaisFrequentes' => $this->estatisticasService->clientesMaisFrequentes(),
            'produtosMaisVendidos' => $this->estatisticasService->produtosMaisVendidos(),
            'servicosMaisVendidos' => $this->estatisticasService->servicosMaisVendidos(),
            'movimentoSemanal' => $this->estatisticasService->movimentoSemanal(),
            'movimentoMensal' => $this->estatisticasService->movimentoMensal(),
            'movimentoAnual' => $this->estatisticasService->movimentoAnual(),
            'clientesPorSexo' => $this->estatisticasService->clientesPorSexo(),
            'clientesPorBairro' => $this->estatisticasService->clientesPorBairro(),
            'clientesPorFaixaEtaria' => $this->estatisticasService->clientesPorFaixaEtaria(),
        ]);
    }

}
