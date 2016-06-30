<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 28/06/2016
 * Time: 09:50
 */

namespace App\Services;


interface MarcasProdutosServiceInterface {

	public function listarTodasOrdenarPorDescricao();

	public function atualizar($id, array $attributes);

	public function cadastrar(array $attributes);

	public function deletar($id);

	public function getById($id);

}