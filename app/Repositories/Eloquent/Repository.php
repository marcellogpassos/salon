<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 14/07/2016
 * Time: 15:23
 */

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CriteriaInterface;
use App\Repositories\Criteria\Criteria;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\RepositoryException;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository implements RepositoryInterface, CriteriaInterface {

    private $app;

    protected $model;

    protected $newModel;

    protected $criteria;

    protected $skipCriteria = false;

    protected $preventCriteriaOverwriting = true;

    protected $defaultPerPage;

    public function __construct(App $app, Collection $collection) {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
        $this->defaultPerPage = env('DEFAULT_PER_PAGE');
    }

    public abstract function model();

    public function all($columns = array('*')) {
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    public function with(array $relations) {
        $this->model = $this->model->with($relations);
        return $this;
    }

    public function lists($value, $key = null) {
        $this->applyCriteria();
        $lists = $this->model->lists($value, $key);
        if (is_array($lists)) {
            return $lists;
        }
        return $lists->all();
    }

    public function paginate($perPage = 0, $columns = array('*')) {
        $perPage = $perPage ? $perPage : $this->defaultPerPage;
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function saveModel(array $data) {
        foreach ($data as $k => $v) {
            $this->model->$k = $v;
        }
        return $this->model->save();
    }

    public function update(array $data, $id, $attribute = "id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function updateRich(array $data, $id) {
        if (!($model = $this->model->findOrFail($id)))
            return false;
        return $model->fill($data)->save();
    }

    public function delete($id) {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->findOrFail($id, $columns);
    }

    public function findBy($attribute, $value, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function findAllBy($attribute, $value, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    public function     findWhere($where, $paginate = false, $perPage = 0, $columns = ['*'], $or = false) {
        $this->applyCriteria();
        $model = $this->model;
        foreach ($where as $field => $value) {
            if ($value instanceof \Closure) {
                $model = (!$or)
                    ? $model->where($value)
                    : $model->orWhere($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;
                    $model = (!$or)
                        ? $model->where($field, $operator, $search)
                        : $model->orWhere($field, $operator, $search);
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;
                    $model = (!$or)
                        ? $model->where($field, '=', $search)
                        : $model->orWhere($field, '=', $search);
                }
            } else {
                $model = (!$or)
                    ? $model->where($field, '=', $value)
                    : $model->orWhere($field, '=', $value);
            }
        }
        return $paginate ? $model->paginate($perPage, $columns) : $model->get($columns);
    }

    public function makeModel() {
        return $this->setModel($this->model());
    }

    public function setModel($eloquentModel) {
        $this->newModel = $this->app->make($eloquentModel);
        if (!$this->newModel instanceof Model)
            throw new RepositoryException("Class {$this->newModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        return $this->model = $this->newModel;
    }

    public function resetScope() {
        $this->skipCriteria(false);
        return $this;
    }

    public function skipCriteria($status = true) {
        $this->skipCriteria = $status;
        return $this;
    }

    public function getCriteria() {
        return $this->criteria;
    }

    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    public function pushCriteria(Criteria $criteria) {
        if ($this->preventCriteriaOverwriting) {
            // Find existing criteria
            $key = $this->criteria->search(function ($item) use ($criteria) {
                return (is_object($item) AND (get_class($item) == get_class($criteria)));
            });
            // Remove old criteria
            if (is_int($key)) {
                $this->criteria->offsetUnset($key);
            }
        }
        $this->criteria->push($criteria);
        return $this;
    }


    public function applyCriteria() {
        if ($this->skipCriteria === true)
            return $this;
        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }
        return $this;
    }

}