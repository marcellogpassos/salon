<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 12/08/2016
 * Time: 22:07
 */

namespace App\Services;


interface FormasPagamentoServiceInterface {

	public function listarTodos();

	public function getFormaPagamento($id);

}