<?php

namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class BaseRepository
 *
 * @package \App\Repositories
 */
class BaseRepository implements BaseContract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function createBulk(array $attributes)
    {
        return $this->model->insert($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, string $id) : bool
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @param array $relationship
     * @return mixed
     */
    public function all($columns = array('*'), string $orderBy = 'created_at', string $sortBy = 'desc', array $relationship = [])
    {
        return $this->model->orderBy($orderBy, $sortBy)->with($relationship)->get($columns);
    }

    /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function paginate(array $data, int $paginate)
    {
        return $this->model->where($data)->paginate($paginate);
    }

    /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function allForOneUser($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc', string $whereColumn, string $operator, $value)
    {
        return $this->model->where($whereColumn, $operator, $value)->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(string $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneOrFail(string $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data)
    {
        return $this->model->where($data)->paginate();
    }

    public function findByWhere(array $data, array $relationship = [])
    {
        return $this->model->where($data)->with($relationship)->latest()->get();
    }

    /**
     * @param array $data
     * @param array $relationship
     * @return mixed
     */
    public function findOneBy(array $data, array $relationship = [])
    {
        return $this->model->where($data)->with($relationship)->first();
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(string $id) : bool
    {
        return $this->model->find($id)->delete();
    }

}
