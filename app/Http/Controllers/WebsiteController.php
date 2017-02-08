<?php

namespace App\Http\Controllers;

use App\CategoriasServicos;
use Illuminate\Http\Request;

use App\Http\Requests;

class WebsiteController extends Controller {

    public function index() {
        $categorias = CategoriasServicos::all();
        return view('website.index')
            ->with('categorias', $categorias);
    }
    
}
