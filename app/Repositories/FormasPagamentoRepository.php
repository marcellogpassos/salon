<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 12/08/2016
 * Time: 22:04
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class FormasPagamentoRepository extends Repository {

	public function model() {
		return 'App\FormaPagamento';
	}

}