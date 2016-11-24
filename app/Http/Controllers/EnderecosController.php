<?php

namespace App\Http\Controllers;

use App\Municipio;
use Illuminate\Http\Request;

use App\Http\Requests;

class EnderecosController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function listarMunicipios($uf) {
        $municipios = Municipio::where('uf_id', $uf)->get();
        return response()->json($municipios);
    }

    public function getMunicipio($municipio) {
        $municipio = Municipio::findOrFail($municipio);
        $uf = $municipio->uf;
        return response()->json($municipio);
    }

}
