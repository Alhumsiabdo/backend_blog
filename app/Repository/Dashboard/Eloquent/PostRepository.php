<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\Post;
use App\Repository\Dashboard\PostRepositoryInterface;


class PostRepository implements PostRepositoryInterface
{

    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }
    public function all()
    {
        return $this->model->all();
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
