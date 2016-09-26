<?php

namespace App\Http\Controllers;

use App\Services\FormasPagamentoServiceInterface;
use App\Services\UsersServiceInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ComprasController extends Controller {

	protected $usersService;

	protected $formasPagamentoService;

	public function __construct(UsersServiceInterface $usersService, FormasPagamentoServiceInterface $formasPagamentoService) {
		$this->usersService = $usersService;
		$this->formasPagamentoService = $formasPagamentoService;
		$this->middleware('auth');
	}

	public function mostrarFormRegistrarCompra($id) {
		$cliente = $this->usersService->getUser($id);
		$caixa = Auth::user();
		$formasPagamento = $this->formasPagamentoService->listarTodos();
		return view('compras.registrar')
			->with('cliente', $cliente)
			->with('caixa', $caixa)
			->with('formasPagamento', $formasPagamento);
	}

} 
