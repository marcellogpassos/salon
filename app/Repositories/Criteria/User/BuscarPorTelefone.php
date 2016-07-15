<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 15/07/2016
 * Time: 09:23
 */

namespace App\Repositories\Criteria\User;

use App\Repositories\Criteria\BuscarChaveValor;

class BuscarPorTelefone extends BuscarChaveValor {

    public function getChave() {
        return 'telefone';
    }

}