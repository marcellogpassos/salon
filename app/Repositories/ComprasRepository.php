<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 04/10/2016
 * Time: 18:05
 */

namespace App\Repositories;


use App\ItemCompra;
use App\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ComprasRepository extends Repository {

    public function model() {
        return 'App\Compra';
    }

    public function createAndPersistItens(array $compra, array $itensCompraArray) {
        $itensCompra = $this->getItensCompra($itensCompraArray);
        $compraSalva = null;

        DB::beginTransaction();

        try {
            $compraSalva = $this->create($compra);
            $compraSalva->itensCompra()->saveMany($itensCompra);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return $compraSalva;
    }

    private function getItensCompra(array $itensCompraArray) {
        $itensCompra = [];
        foreach ($itensCompraArray as $item)
            array_push($itensCompra, new ItemCompra([
                'item_id' => $item['item_id'],
                'quantidade' => $item['quantidade'],
                'valor_unitario_corrente' => $item['valor_unitario_corrente'],
            ]));
        return $itensCompra;
    }

}