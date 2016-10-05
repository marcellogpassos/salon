<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 04/10/2016
 * Time: 17:47
 */

namespace App\Services;


interface ComprasServiceInterface {

    public function cadastrar(array $compra);

    public function criarCompra($clienteId, $caixaId, array $attributes);

    public function gerarCodigoValidacao($compra);

}