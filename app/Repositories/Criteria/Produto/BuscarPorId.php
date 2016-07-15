<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 15/07/2016
 * Time: 09:57
 */

namespace App\Repositories\Criteria\Produto;


use App\Repositories\Criteria\BuscarChaveValor;

class BuscarPorId extends BuscarChaveValor{

    public function getChave() {
        return 'id';
    }

}