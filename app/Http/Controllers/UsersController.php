<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function mostrarFormEditarDadosUsuario () {
        return view('users.dados')->with('user', Auth::user());
    }

}
