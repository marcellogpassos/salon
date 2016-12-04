<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 03/12/2016
 * Time: 22:52
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class AgendamentosRepository extends Repository{

	public function model() {
		return 'App\Agendamento';
	}

}