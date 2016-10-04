<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 11/07/2016
 * Time: 16:02
 */

namespace App\Services;


interface BandeirasCartoesServiceInterface {

    public function listarTodos();

    public function getBandeiraCartao($id);

}