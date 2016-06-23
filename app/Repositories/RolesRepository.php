<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 23/06/2016
 * Time: 08:27
 */

namespace App\Repositories;


use App\Role;

class RolesRepository implements RolesRepositoryInterface {

	protected $model;

	public function __construct(Role $model) {
		$this->model = $model;
	}

	public function getAll() {
		return $this->model->all();
	}

}