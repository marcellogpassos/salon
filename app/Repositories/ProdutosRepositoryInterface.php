<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 06/07/2016
 * Time: 09:42
 */

namespace App\Repositories;


interface ProdutosRepositoryInterface {

	public function getAll($orderBy);
	
	public function buscar($criterios);

	public function getById($id);

	public function delete($id);

}