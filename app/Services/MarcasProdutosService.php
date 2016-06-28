<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 28/06/2016
 * Time: 09:50
 */

namespace App\Services;


use App\Repositories\MarcasProdutosRepositoryInterface;

class MarcasProdutosService implements MarcasProdutosServiceInterface {

	protected $marcasRepository;

	public function __construct(MarcasProdutosRepositoryInterface $repository) {
		$this->marcasRepository = $repository;
	}

	public function listarTodasOrdenarPorDescricao() {
		return $this->marcasRepository->getAll('descricao');
	}

	public function cadastrar(array $attributes) {
		if(!$attributes)
			abort(400);
		return $this->marcasRepository->create($attributes);
	}
}