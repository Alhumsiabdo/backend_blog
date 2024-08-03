<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repository\Dashboard\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function showCommentsByPostId($post)
    {
        $comments = $this->commentRepository->show($post);
        if($comments)
        {
            return ApiResponse::success($comments);
        } else {
            return ApiResponse::error("Post not found.", [], 404);
        }
    }

    public function destroy($id)
    {
        $comment = $this->commentRepository->destroy($id);
        if($comment)
        {
            return ApiResponse::success($comment, "Comment Deleted Successfully.", 200);
        } else {
            return ApiResponse::error("Comment not found.", [], 404);
        }
    }
}
