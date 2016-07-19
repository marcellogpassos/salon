<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 19/07/2016
 * Time: 11:15
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class ItemVendaRepository extends Repository {

	public function model() {
		return 'App\ItemVenda';
	}
}