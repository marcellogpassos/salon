<?php

namespace App\Repositories\Criteria\Produto;

use App\Repositories\Criteria\BuscarChaveValor;

class BuscarPorMarca extends BuscarChaveValor {

    public function getChave() {
        return 'marca_id';
    }

}