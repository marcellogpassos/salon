<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 15/07/2016
 * Time: 09:16
 */

namespace App\Repositories\Criteria\User;

use App\Repositories\Criteria\Criteria;
use App\Repositories\Contracts\RepositoryInterface as Repository;
use Illuminate\Support\Facades\DB;

class BuscarPorNomeSobrenome extends Criteria {

    protected $string;

    public function __construct($string) {
        $this->string = $string;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where(
            DB::raw('concat(name, " ", surname)'),
            'like',
            '%' . $this->string . '%'
        );
        return $query;
    }

}