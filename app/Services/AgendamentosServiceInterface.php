<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 03/12/2016
 * Time: 20:59
 */

namespace App\Services;


interface AgendamentosServiceInterface {

	public function listarTodos();

	public function listarAgendamentosPorUsuario($clienteId);

	public function cadastrarAgendamento($clienteId, array $atributos);

}