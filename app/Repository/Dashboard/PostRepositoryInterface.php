<?php

namespace App\Repository\Dashboard;

use Illuminate\Database\Eloquent\Collection;

Interface PostRepositoryInterface {

    public function getAll(array $columns = ['*'], array $relations = []): Collection;
    public function paginate(int $perPage = 10, array $relations = [], $orderBy = 'ASC', $columns = ['*']);
    public function show($id);
    public function toggleStatus($id);
    public function destroy($id);
}
