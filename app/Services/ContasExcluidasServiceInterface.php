<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 20/01/2017
 * Time: 13:07
 */

namespace App\Services;


interface ContasExcluidasServiceInterface {

    public function cadastrarContaExcluida($user, $motivo, $stars);

}