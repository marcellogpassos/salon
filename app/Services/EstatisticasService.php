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

    protected $faixaEtariaAnos;

    protected $faixaEtariaQuantidade;

    public function __construct() {
        $this->faixaEtariaAnos = env('FAIXA_ETARIA_ANOS');
        $this->faixaEtariaQuantidade = env('FAIXA_ETARIA_QUANTIDADE');
    }

    protected function getResult($queryName) {
        $query = Config::get($queryName);
        return DB::select($query);
    }

    public function clientesMaisRentaveis() {
        return $this->getResult('queries.clientesMaisRentaveis');
    }

    public function clientesMaisFrequentes() {
        return $this->getResult('queries.clientesMaisFrequentes');
    }

    public function produtosMaisVendidos() {
        return $this->getResult('queries.produtosMaisVendidos');
    }

    public function servicosMaisVendidos() {
        return $this->getResult('queries.servicosMaisVendidos');
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

    public function clientesPorBairro() {
        return $this->getResult('queries.clientesPorBairro');
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
            $faixasEtarias = array_add($faixasEtarias, $faixaLabel, $quantidade);
        }
        return $faixasEtarias;
    }

}