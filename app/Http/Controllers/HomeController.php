<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (!Auth::user()->cpf){
			session()->flash('warning', Config::get('messages.warning')[0]);
			return redirect()->action('UsersController@mostrarFormEditarDadosUsuario');
		}
		else
			return view('home')->with('user', Auth::user());
	}
}
