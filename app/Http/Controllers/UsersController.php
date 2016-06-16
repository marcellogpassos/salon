<?php

namespace App\Http\Controllers;

use App\Services\UsersServiceInterface;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UsersController extends Controller {

    protected $usersService;

    public function __construct(UsersServiceInterface $service) {
        $this->usersService = $service;

        $this->middleware('auth');
    }

    public function mostrarFormEditarDadosUsuario() {
        return view('users.dados')->with('user', Auth::user());
    }

    public function editarDadosUsuario(UsersRequest $request) {
        $usuarioAtualizado = $this->usersService->atualizarPropriosDados($request->all());

        showMessage('success', 0, [$usuarioAtualizado->name]);

        return redirect('home');
    }

}
