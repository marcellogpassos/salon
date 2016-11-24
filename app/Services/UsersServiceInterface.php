<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 15/06/2016
 * Time: 22:04
 */

namespace App\Services;


interface UsersServiceInterface {

	public function buscar($criterios);

	public function atualizarDados($id, array $attributes);

	public function salvarFoto($foto);

	public function deletarFoto($filename);

	public function apagarFoto($user);

	public function atualizarFoto($user, $foto);

	public function getUser($id);

	public function sincronizarPapeis($userId, array $roles);

	public function listarFuncionarios();

}