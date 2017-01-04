<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 29/12/2016
 * Time: 16:39
 */

namespace App\Services;


use App\User;

interface MensagensServiceInterface {

	public function cadastrar($remetente, $destinatario, $assunto, $mensagem);

	public function listarMensagensRecebidasPorUsuario(User $user);

}