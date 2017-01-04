<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 29/12/2016
 * Time: 16:36
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class MensagensRepository extends Repository {

	public function model() {
		return 'App\Mensagem';
	}

}