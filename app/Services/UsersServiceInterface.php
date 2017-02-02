<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 15/06/2016
 * Time: 22:04
 */

namespace App\Services;


use App\Agendamento;

interface UsersServiceInterface {

    public function buscar($criterios);

    public function atualizarDados($id, array $attributes);

    public function salvarFoto($foto);

    public function deletarFoto($filename);

    public function apagarFoto($user);

    public function atualizarFoto($user, $foto);

    public function getUser($id);

    public function sincronizarPapeis($userId, array $roles);

    public function atualizarCurriculo($userId, $curriculo);

    public function listarFuncionarios();

    public function getInteressadosAgendamento(Agendamento $agendamento);

    public function getAdministradores();

    public function setStatusUsuario($user, $ativo);

    public function excluirUsuario($user);

    public function getUsersEmail($users);

    public function alterarSenha($user, $novaSenha);

    public function validarSenha($userId, $senha);

    public function cadastrarCliente($dados);

}