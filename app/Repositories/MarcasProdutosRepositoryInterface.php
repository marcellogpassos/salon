<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 28/06/2016
 * Time: 09:45
 */

namespace App\Repositories;


interface MarcasProdutosRepositoryInterface {

	public function delete($id);

	public function getAll($orderBy);

	public function getById($id);

	public function create(array $attributes);

	public function update($id, array $attributes);

}