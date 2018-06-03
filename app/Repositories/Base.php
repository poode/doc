<?php

namespace App\Repositories;

use Spatie\QueryBuilder\QueryBuilder;

class Base
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }
    /**
     * @param  $attribute
     * @param  $value
     * @param  $relations
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOneByOrFail($attribute, $value, $relations = null)
    {
        $query = $this->model->where($attribute, $value);

        if ($relations && is_array($relations)) {
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        }

        return $query->firstOrFail();
    }

    /**
     * Find a record by its identifier.
     *
     * @param  string                                     $id
     * @param  array                                      $relations
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id, $relations = null)
    {
        return $this->findOneBy($this->model->getKeyName(), $id, $relations);
    }

    /**
     * Find a record by an attribute.
     * Fails if no model is found.
     *
     * @param  string                                     $attribute
     * @param  string                                     $value
     * @param  array                                      $relations
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findOneBy($attribute, $value, $relations = null)
    {
        $query = $this->model->where($attribute, $value);

        if ($relations && is_array($relations)) {
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        }

        return $query->first();
    }
    /**
     * Fills out an instance of the model
     * with $attributes.
     *
     * @param  array                                 $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fill($attributes)
    {
        return $this->model->fill($attributes);
    }

    /**
     * Fills out an instance of the model
     * and saves it, pretty much like mass assignment.
     *
     * @param  array                                 $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fillAndSave($attributes)
    {
        $this->model->fill($attributes);
        $this->model->save();

        return $this->model;
    }

    /**
     * Remove a selected record.
     *
     * @param  string $key
     * @return bool
     */
    public function remove($key)
    {
        return $this->model->where($this->model->getKeyName(), $key)->delete();
    }

    /**
     * @param $value
     */
    public function queryFor($value = null): QueryBuilder
    {
        return QueryBuilder::for ($value);
    }
}
