<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 15:39
 */

namespace App\Repositories\Criteria;

use App\Repositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria {

    public abstract function apply($model, Repository $repository);

}