<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 03/12/2016
 * Time: 20:59
 */

namespace App\Services;


use App\Agendamento;
use App\Repositories\AgendamentosRepository;
use Carbon\Carbon;

class AgendamentosService implements AgendamentosServiceInterface {

    protected $agendamentosRepository;

    public function __construct(AgendamentosRepository $repository) {
        $this->agendamentosRepository = $repository;
    }

    public function listarTodos() {
        return $this->agendamentosRepository->all();
    }

    public function listarAgendamentosPorUsuario($clienteId) {
        $hoje = Carbon::today();
        $agendamentos = Agendamento::where('cliente_id', $clienteId)
            ->where('data', '>=', $hoje)
            ->whereNull('data_cancelamento')
            ->get();
        return $agendamentos;
    }

    public function cadastrarAgendamento($clienteId, array $atributos) {
        if (!$atributos['profissional_id'])
            $atributos = array_except($atributos, ['profissional_id']);
        return $this->agendamentosRepository->create(array_add($atributos, 'cliente_id', $clienteId));
    }

    public function cancelarAgendamento($clienteId, $agendamentoId) {
        $agendamento = Agendamento::where('cliente_id', $clienteId)
            ->where('id', $agendamentoId)
            ->whereNull('data_cancelamento')
            ->firstOrFail();
        $agendamento->data_cancelamento = Carbon::now();
        return $agendamento->save();
    }
}