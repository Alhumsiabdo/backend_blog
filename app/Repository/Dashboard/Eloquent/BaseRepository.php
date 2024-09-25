<?php

namespace App\Repository\Dashboard\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function paginate(
        int $perPage = 10,
        array $relations = [],
        $orderBy = 'ASC',
        $columns = ['*'],
        string $conditionColumn = null,
        string $conditionValue = null
    ) {
        $query = $this->model::query()
            ->select($columns)
            ->with($relations)
            ->orderBy('id', $orderBy);

        // Apply condition only if both conditionColumn and conditionValue are provided
        if ($conditionColumn && $conditionValue) {
            $query->where($conditionColumn, $conditionValue);
        }

        return $query->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->model->find($id);
        if ($item) {
            $item->update($data);
            return $item;
        }

        return null;
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        if ($item) {
            $item->delete();
            return true;
        }

        return false;
    }
}
