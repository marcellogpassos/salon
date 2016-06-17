<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 15/06/2016
 * Time: 22:04
 */

namespace App\Services;


use App\Repositories\UsersRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UsersService implements UsersServiceInterface {

	protected $usersRepository;

	public function __construct(UsersRepositoryInterface $repository) {
		$this->usersRepository = $repository;
	}

	public function atualizarPropriosDados(array $attributes) {
		return $this->usersRepository->update(Auth::user()->id, $attributes);
	}

	public function getUser($id) {
		return $this->usersRepository->getById($id);
	}
}