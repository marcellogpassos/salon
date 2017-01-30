<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 04/10/2016
 * Time: 17:47
 */

namespace App\Services;


interface ComprasServiceInterface {

	public function buscar($criterios);

	public function cadastrar(array $compra);

	public function criarCompra($caixaId, array $attributes, $clienteId = null);

	public function gerarCodigoValidacao($compra);

	public function getByCodigoValidacao($codigoValidacao);

	public function cancelarCompra($compra);

}