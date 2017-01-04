<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 29/12/2016
 * Time: 16:39
 */

namespace App\Services;


use App\Mensagem;
use App\Repositories\MensagensRepository;
use App\User;
use Illuminate\Support\Facades\Mail;

class MensagensService implements MensagensServiceInterface {

	protected $mensagensRepository;

	public function __construct(MensagensRepository $repository) {
		$this->mensagensRepository = $repository;
	}

	public function cadastrar($remetente, $destinatario, $assunto, $mensagem) {
		$mensagem = $this->salvarMensagem($remetente, $destinatario, $assunto, $mensagem);
		$this->notificarCliente($mensagem);
		return $mensagem;
	}

	public function listarMensagensRecebidasPorUsuario(User $user) {
		// TODO: Implement listarMensagensRecebidasPorUsuario() method.
	}

	private function salvarMensagem($remetente, $destinatario, $assunto, $message) {
		$mensagem = new Mensagem;
		$mensagem->remetente_id = $remetente->id;
		$mensagem->destinatario_id = $destinatario->id;
		$mensagem->assunto = $assunto;
		$mensagem->mensagem = $message;
		$mensagem->save();
		return $mensagem;
	}

	private function notificarCliente(Mensagem $mensagem) {
		Mail::send('emails.mensagens.mensagem',
			['mensagem' => $mensagem],
			function ($message) use ($mensagem) {
				return $message
					->to($mensagem->destinatario->email)
					->subject($mensagem->assunto);
			}
		);
	}
}