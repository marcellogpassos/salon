<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 15/06/2016
 * Time: 22:04
 */

namespace App\Services;


interface UsersServiceInterface {

	public function atualizarPropriosDados(array $attributes);

	public function getUser($id);

}