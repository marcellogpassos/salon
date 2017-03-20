<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 03/12/2016
 * Time: 20:59
 */

namespace App\Services;


use App\Agendamento;

interface AgendamentosServiceInterface {

	public function getAgendamento($id);

	public function listarTodos();

	public function listarAgendamentosPorUsuario($clienteId);

	public function cadastrarAgendamento($clienteId, array $atributos);

	public function cadastrarMultiplosAgendamento($agendamentos);

	public function cancelarAgendamento($clienteId, $agendamentoId);

	public function minhaAgenda($start, $end, $profissionalId = null);

	public function meusAgendamentosPendentes($start, $end = null, $profissionalId = null);

	public function analisar($agendamentoId, $status, $justificativa = null);

	public function agendaDoDia($dia, $profissionalId = null);

}