<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersBuscarRequest;
use App\Municipio;
use App\Services\RolesServiceInterface;
use App\Services\UsersServiceInterface;
use App\Http\Requests\UsersDadosRequest;
use App\Uf;
use App\User;
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
		if (!count($request->all()))
			return view('users.buscar');
		$usersEncontrados = $this->usersService->buscar($request->all());
		return view('users.buscar')
			->with('usersEncontrados', $usersEncontrados)
			->with('buscaPrevia', $request->all());
	}

	public function mostrarFormEditarDadosUsuario() {
		$user = Auth::user();
		$ufs = Uf::all();
		$municipios = isset($user->municipio) ? Municipio::where('uf_id', $user->municipio->uf_id)->get() : null;
		return view('users.dados')
			->with('user', $user)
			->with('ufs', $ufs)
			->with('municipios', $municipios);
	}

	public function mostrarFormGerenciarPapeis($id) {
		$user = $this->usersService->getUser($id);
		$roles = $this->rolesService->listarTodos();
		return view('users.roles')
			->with('user', $user)
			->with('roles', $roles);
	}

	public function editarDadosUsuario(UsersDadosRequest $request) {
		$user = Auth::user();
		$sucesso = $this->usersService->atualizarDados($user->id, $request->all());
		if (!$request->hasFile('foto') && $request->has('foto_anterior'))
			$this->usersService->apagarFoto($user);
		if ($request->hasFile('foto') && $request->file('foto')->isValid())
			$this->usersService->atualizarFoto($user, $request->file('foto'));
		if ($sucesso)
			showMessage('success', 0);
		else
			showMessage('error', 3);
		return redirect('home');
	}

	public function editarPapeis($id, Request $request) {
		$this->usersService->sincronizarPapeis($id, $request->input('roles'));
		$this->usersService->atualizarCurriculo($id, $request->has('curriculo') ? $request->input('curriculo') : null);
		showMessage('success', 1);
		return $this->mostrarFormGerenciarPapeis($id);
	}

	public function recuperarUsuario($id) {
		$user = $this->usersService->getUser($id);
		$municipio = $user->municipio;
		if ($municipio)
			$uf = $user->municipio->uf;
		return response()->json($user);
	}

}
