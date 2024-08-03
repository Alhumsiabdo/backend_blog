<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\Comment;
use App\Repository\Dashboard\CommentRepositoryInterface;


class CommentRepository implements CommentRepositoryInterface
{

    protected $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function show($post)
    {
        return $this->model->where('post_id', $post)->get();
    }
    public function destroy($id)
    {
        $comment = $this->model->find($id);
        if ($comment) {
            $comment->delete();
            return true;
        }
    }
}
