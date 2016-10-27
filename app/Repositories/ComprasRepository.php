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

	public function buscar($criterios, $perPage = null) {
		if (filtroFornecido($criterios, 'codigo_validacao'))
			return $this->findBy('codigo_validacao', $criterios['codigo_validacao']);
		$perPage = $perPage ? $perPage : env('DEFAULT_PER_PAGE');

		if (filtroFornecido($criterios, 'data_final'))
			$criterios['data_final'] = fimDoDia($criterios['data_final']);
		$where = $this->montarWhere($criterios);

		$compras = $this->model->select('compras.*')
			->join('item_compra', 'compras.id', '=', 'item_compra.compra_id')
			->where($where)
			->groupBy('compras.id')
			->paginate($perPage);

		return $compras;
	}

	private function montarWhere($criterios) {
		$where = [];
		$where = filtrar($criterios, $where, 'compras.data_compra', 'data_inicial', '>=');
		$where = filtrar($criterios, $where, 'compras.data_compra', 'data_final', '<=');
		$where = filtrar($criterios, $where, 'compras.valor_total', 'valor_minimo', '>=');
		$where = filtrar($criterios, $where, 'compras.valor_total', 'valor_maximo', '<=');
		$where = filtrar($criterios, $where, 'compras.cliente_id', 'cliente');
		$where = filtrar($criterios, $where, 'item_compra.item_id', 'item');
		return $where;
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