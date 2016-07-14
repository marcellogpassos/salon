<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 15:23
 */

namespace App\Repositories\Contracts;


use App\Repositories\Criteria\Criteria;

interface CriteriaInterface {

    public function skipCriteria($status = true);

    public function getCriteria();

    public function getByCriteria(Criteria $criteria);

    public function pushCriteria(Criteria $criteria);

    public function applyCriteria();

}