<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 27/07/2016
 * Time: 10:38
 */

namespace App\Services;


interface ServicoServiceInterface {

	public function cadastrar(array $servicoAttr, array $itemVendaAttr);

}