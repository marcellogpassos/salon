<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersBuscarRequest;
use App\Services\RolesServiceInterface;
use App\Services\UsersServiceInterface;
use App\Http\Requests\UsersDadosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

	protected $usersService;
	protected $rolesService;

	public function __construct(UsersServiceInterface $usersService, RolesServiceInterface $rolesService) {
		$this->usersService = $usersService;
		$this->rolesService = $rolesService;
		$this->middleware('auth');
	}

	public function mostrarFormBuscarUsuarios(Request $request) {
		$userId = $request->input('user');
		return view('users.buscar');
	}

	public function mostrarUsuariosEncontrados(UsersBuscarRequest $request) {
		if(!count($request->all()))
			return view('users.buscar');
		$usersEncontrados = $this->usersService->buscar($request->all());
		return view('users.buscar')
			->with('usersEncontrados', $usersEncontrados)
			->with('buscaPrevia', $request->all());
	}

	public function mostrarFormEditarDadosUsuario() {
		return view('users.dados')->with('user', Auth::user());
	}

	public function mostrarFormGerenciarPapeis($id) {
		$user = $this->usersService->getUser($id);
		$roles = $this->rolesService->listarTodos();
		return view('users.roles')
			->with('user', $user)
			->with('roles', $roles);
	}

	public function editarDadosUsuario(UsersDadosRequest $request) {
		$sucesso = $this->usersService->atualizarPropriosDados($request->all());
		if($sucesso)
			showMessage('success', 0);
		else
			showMessage('error', 3);
		return redirect('home');
	}

	public function editarPapeis($id, Request $request) {
		$this->usersService->sincronizarPapeis($id, $request->input('roles'));
		showMessage('success', 1);
		return $this->mostrarFormGerenciarPapeis($id);
	}

	public function recuperarUsuario($id) {
		$user = $this->usersService->getUser($id);
		return response()->json($user);
	}

}
