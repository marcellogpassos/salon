<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 15:23
 */

namespace App\Repositories\Contracts;


interface RepositoryInterface {

    public function all($columns = array('*'));

    public function paginate($perPage = 0, $columns = array('*'));

    public function create(array $data);

    public function saveModel(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));

    public function findAllBy($field, $value, $columns = array('*'));

    public function findWhere($where, $columns = array('*'));

}