<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		if (Auth::user()->dados_atualizados)
			return redirect('/');

		showMessage('warning', 0);

		return redirect()->action('UsersController@mostrarFormEditarDadosUsuario');

	}
}
