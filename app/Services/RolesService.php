<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 23/06/2016
 * Time: 08:31
 */

namespace App\Services;


use App\Repositories\RolesRepositoryInterface;

class RolesService implements RolesServiceInterface {

	protected $rolesRepository;

	public function __construct(RolesRepositoryInterface $repository) {
		$this->rolesRepository = $repository;
	}

	public function listarTodos() {
		return $this->rolesRepository->getAll();
	}

}