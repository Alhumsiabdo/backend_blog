<?php

namespace App\Repository\Dashboard;

use Illuminate\Database\Eloquent\Collection;

interface AdminRepositoryInterface
{
    public function getAll(array $columns = ['*'], array $relations = []): Collection;
    public function paginate(int $perPage = 10, array $relations = [], $orderBy = 'ASC', $columns = ['*']);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
