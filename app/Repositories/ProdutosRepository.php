<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 06/07/2016
 * Time: 09:42
 */

namespace App\Repositories;


use App\Produto;

class ProdutosRepository implements ProdutosRepositoryInterface {

	protected $model;

	protected $perPage;

	public function __construct(Produto $model) {
		$this->perPage = env('PRODUTOS_PER_PAGE');
		$this->model = $model;
	}

	public function getAll($orderBy) {
		if (!$orderBy)
			return $this->model
				->paginate($this->perPage);
		return $this->model
			->orderBy($orderBy)
			->paginate($this->perPage);
	}

}