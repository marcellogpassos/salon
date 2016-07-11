<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 11/07/2016
 * Time: 15:59
 */

namespace App\Repositories;


interface CategoriasProdutosRepositoryInterface {

    public function getAll($orderBy);

}