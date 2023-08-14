<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{

    public const PERPAGE = 5;
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $page
     * @return array
     */
    public function paginate(int $page)
    {
        return $this->model->limit(self::PERPAGE)->offset(self::PERPAGE * ($page - 1))->get();
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->model->all()->toArray();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->model->get()->toArray();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function updateById(int $id, array $newValuesPost): bool
    {
        return $this->model->whereId($id)->update($newValuesPost);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        return (bool)$this->find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function doesntExist(int $id): bool
    {
        return !$this->exists($id);
    }

    /**
     * @param array $post
     * @return Model
     */
    public function create(array $entitySaveData): Model
    {
        return $this->model->create($entitySaveData);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->model->whereId($id)->delete();
    }
}
