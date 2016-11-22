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

    public function getMunicipio($uf, $municipio) {
        $municipio = Municipio::where('uf_id', $uf)->where('id', $municipio)->firstOrFail();
        return response()->json($municipio);
    }

}
