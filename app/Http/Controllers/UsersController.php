<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositoryInterface;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller {

    protected $usersRepository;

    public function __construct(UsersRepositoryInterface $repository) {
        $this->usersRepository = $repository;

        $this->middleware('auth');
    }

    public function mostrarFormEditarDadosUsuario() {
        return view('users.dados')->with('user', Auth::user());
    }

    public function editarDadosUsuario(UsersRequest $request) {
        $this->usersRepository->update(Auth::user()->id, $request->all());

        session()->flash('success', Config::get('messages.success')[0]);

        return redirect('home');
    }

}
