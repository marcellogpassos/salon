<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 11/07/2016
 * Time: 16:02
 */

namespace App\Services;

use App\Repositories\BandeiraCartaoRepository as BandCartao;

class BandeirasCartoesService implements BandeirasCartoesServiceInterface {

    protected $bandeiras;

    public function __construct(BandCartao $repository) {
        $this->bandeiras = $repository;
    }

    public function listarTodos() {
        return $this->bandeiras->all();
    }

    public function getBandeiraCartao($id) {
        return $this->bandeiras->find($id);
    }

}