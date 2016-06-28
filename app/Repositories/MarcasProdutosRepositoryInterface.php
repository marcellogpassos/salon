<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 28/06/2016
 * Time: 09:45
 */

namespace App\Repositories;


interface MarcasProdutosRepositoryInterface {

	public function getAll($orderBy);

	public function create(array $attributes);

}