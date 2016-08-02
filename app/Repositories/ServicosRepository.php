<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 27/07/2016
 * Time: 10:37
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class ServicosRepository extends Repository {

	public function model() {
		return 'App\Servico';
	}

	public function sincronizarFuncionarios($id, array $funcionarios) {
		$servico = $this->find($id);
		return $servico->funcionariosHabilitados()->sync($funcionarios);
	}

}