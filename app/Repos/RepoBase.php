<?php 

namespace App\Repos;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class RepoBase
{
    public $model;

    public $order = 'ASC';

    public $paramOrder = 'id';

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    abstract public function create($data);

    /**
     * Encuentra todos los elementos
     *
     * @param array $select
     * @param array $filter
     * @return void
     */
    public function find($select = ['*'], $filter = [])
    {
        return $this->model->select($select)->filter($filter)->orderBy(
            $this->getParamOrder(), 
            $this->getOrder()
            )->get();
    }

    public function count($filter = [])
    {
        return $this->model->select(['id'])->filter($filter)->get()->count();
    }

    /**
     * Encuentra solo un elemento
     *
     * @param array $select
     * @param array $filter
     * @return void
     */
    public function findFirst($select = ['*'], $filter = [])
    {
        return $this->model->select($select)->filter($filter)->orderBy(
            $this->getParamOrder(), 
            $this->getOrder()
            )->first();
    }

    /**
     * Elimina un registro mediante su ID
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * Encuentra un elemento por su ID
     *
     * @param [type] $id
     * @return void
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Actualiza un elemento en la base de datos
     *
     * @param [type] $id
     * @param array $data
     * @return void
     */
    public function update($id, $data = [])
    {
        $item = $this->model->where('id', $id)->first();
        $item->update($data);
        $item->save();
        return $item;
    }

    /**
     * Get the value of paramOrder
     */ 
    public function getParamOrder()
    {
        return $this->paramOrder;
    }

    /**
     * Set the value of paramOrder
     *
     * @return  self
     */ 
    public function setParamOrder($paramOrder)
    {
        $this->paramOrder = $paramOrder;

        return $this;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of order
     *
     * @return  self
     */ 
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }
}