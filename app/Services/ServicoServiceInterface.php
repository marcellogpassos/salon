<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 27/07/2016
 * Time: 10:38
 */

namespace App\Services;


interface ServicoServiceInterface {

    public function getById($id);

    public function cadastrar(array $servicoAttr, array $itemVendaAttr);

    public function definirFuncionariosHabilitados($id, array $funcionarios);

    public function buscar($criterios);

    public function listarTodasOrdenarPorDescricao();

    public function editar($id, array $servicoAttr, array $itemVendaAttr);

}