<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 20/01/2017
 * Time: 13:22
 */

namespace App\Repositories;


use App\Repositories\Eloquent\Repository;

class ContasExcluidasRepository extends Repository{

    public function model() {
        return 'App\ContasExcluidas';
    }
    
}