<?php

namespace App\Http\Controllers;

use App\Services\MensagensServiceInterface;
use App\Services\UsersServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class MensagensController extends Controller {

	protected $mensagensService;

	protected $usersService;

	public function __construct(MensagensServiceInterface $mensagensService, UsersServiceInterface $usersService) {
		$this->mensagensService = $mensagensService;
		$this->usersService = $usersService;
	}

	public function enviarMensagem(Request $request) {
		$remetente = Auth::user();
		$destinatario = $this->usersService->getUser($request->input('destinatario_id'));
		$assunto = $request->input('assunto');
		$message = $request->input('mensagem');

		$mensagem = $this->mensagensService->cadastrar($remetente, $destinatario, $assunto, $message);

		if ($mensagem)
			showMessage('success', 15, [$destinatario->name . ' ' . $destinatario->surname]);
		else
			showMessage('error', 11);

		return back()->withInput();
	}

}
