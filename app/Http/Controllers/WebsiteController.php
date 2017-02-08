<?php

namespace App\Http\Controllers;

use App\CategoriasServicos;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller {

    public function index() {
        $equipe = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->whereNotNull('curriculo')
            ->whereNotNull('foto')
            ->select('users.*')
            ->distinct()
            ->get();
        $categorias = CategoriasServicos::all();
        return view('website.index')
            ->with('categorias', $categorias)
            ->with('equipe', $equipe);
    }

}
