<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\Tag;
use App\Repository\Dashboard\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }
    public function all()
    {
        return $this->model->all();
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
        $category = $this->model->find($id);
        if ($category) {
            $category->update($data);
            return $category;
        }

        return null;
    }

    public function delete($id)
    {
        $category = $this->model->find($id);
        if ($category) {
            $category->delete();
            return true;
        }

        return false;
    }
}
