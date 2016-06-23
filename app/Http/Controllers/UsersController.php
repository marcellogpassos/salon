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
		$usuarioAtualizado = $this->usersService->atualizarPropriosDados($request->all());
		showMessage('success', 0, [$usuarioAtualizado->name]);
		return redirect('home');
	}

	public function recuperarUsuario($id) {
		$user = $this->usersService->getUser($id);
		return response()->json($user);
	}

}
