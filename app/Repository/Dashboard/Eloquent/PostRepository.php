<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\Post;
use App\Repository\Dashboard\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{

    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }
    public function getAll(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function paginate(int $perPage = 10, array $relations = [], $orderBy = 'ASC', $columns = ['*'])
    {
        return $this->model::query()->select($columns)->with($relations)->orderBy('id', $orderBy)->paginate($perPage);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function toggleStatus($id)
    {
        $post = $this->model->find($id);

        if (!$post) {
            return false;
        }

        $post->status = $post->status === 'published' ? 'draft' : 'published';

        return $post->save();
    }

    public function destroy($id)
    {
        $post = $this->model->find($id);
        if ($post) {
            $post->delete();
            return true;
        }
    }
}
