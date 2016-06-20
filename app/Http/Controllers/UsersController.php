<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersBuscarRequest;
use App\Services\UsersServiceInterface;
use App\Http\Requests\UsersDadosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

    protected $usersService;

    public function __construct(UsersServiceInterface $service) {
        $this->usersService = $service;

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

    public function editarDadosUsuario(UsersDadosRequest $request) {
        $usuarioAtualizado = $this->usersService->atualizarPropriosDados($request->all());

        showMessage('success', 0, [$usuarioAtualizado->name]);

        return redirect('home');
    }

}
