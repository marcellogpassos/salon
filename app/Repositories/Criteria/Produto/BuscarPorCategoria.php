<?php

namespace App\Repositories\Criteria\Produto;

use App\Repositories\Criteria\BuscarChaveValor;

class BuscarPorCategoria extends BuscarChaveValor {

    public function getChave() {
        return 'categoria_id';
    }

}