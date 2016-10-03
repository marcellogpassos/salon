<?php namespace App\Repositories;

use App\Repositories\Eloquent\Repository;

class BandeiraCartaoRepository extends Repository {

    public function model() {
        return 'App\BandeiraCartao';
    }

}