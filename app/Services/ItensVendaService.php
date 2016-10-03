<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 03/10/2016
 * Time: 18:29
 */

namespace App\Services;

use App\Repositories\ItemVendaRepository as ItensVenda;

class ItensVendaService implements ItensVendaServiceInterface {

    protected $itensVenda;

    public function __construct(ItensVenda $repository) {
        $this->itensVenda = $repository;
    }

    public function getItemVenda($id) {
        return $this->itensVenda->find($id);
    }

}