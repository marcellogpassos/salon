<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 28/06/2016
 * Time: 09:45
 */

namespace App\Repositories;


use App\MarcasProdutos;

class MarcasProdutosRepository implements MarcasProdutosRepositoryInterface {

	protected $model;

	public function __construct(MarcasProdutos $model) {
		$this->model = $model;
	}

	public function getAll($orderBy) {
		if (!$orderBy)
			return $this->model->all();
		return $this->model->orderBy($orderBy)->get();
	}

	public function getById($id) {
		return $this->model->findOrFail($id);
	}

	public function create(array $attributes) {
		return $this->model->create($attributes);
	}

	public function update($id, array $attributes) {
		$marca = $this->model->findOrFail($id);
		$marca->update($attributes);
		return $marca;
	}

	public function delete($id) {
		return $this->getById($id)->delete();
		return true;
	}

}