<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 06/07/2016
 * Time: 09:42
 */

namespace App\Repositories;


use App\Produto;

class ProdutosRepository implements ProdutosRepositoryInterface {

    protected $model;

    protected $perPage;

    public function __construct(Produto $model) {
        $this->perPage = env('PRODUTOS_PER_PAGE');
        $this->model = $model;
    }

    public function getAll($orderBy) {
        if (!$orderBy)
            return $this->model
                ->paginate($this->perPage);
        return $this->model
            ->orderBy($orderBy)
            ->paginate($this->perPage);
    }

    public function buscar($criterios) {
        $query = $this->model;
        $query = filtroFornecido($criterios, 'id') ? $query->where('id', $criterios['id']) : $query;
        $query = filtroFornecido($criterios, 'descricao') ? $query->where('descricao', 'like', '%' . $criterios['descricao'] . '%') : $query;
        $query = filtroFornecido($criterios, 'categoria_id') ? $query->where('categoria_id', $criterios['categoria_id']) : $query;
        $query = filtroFornecido($criterios, 'marca_id') ? $query->where('marca_id', $criterios['marca_id']) : $query;

        return $query->orderBy('descricao')->get();
    }

}