<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repository\Dashboard\PostRepositoryInterface;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->all();
        return ApiResponse::success($posts);
    }

    public function show($id)
    {
        $post = $this->postRepository->show($id);
        if ($post) {
            return ApiResponse::success($post);
        }
        return ApiResponse::error("Post not found", [], 404);
    }

    public function changeStatus($id)
    {
        $success = $this->postRepository->toggleStatus($id);
        if ($success) {
            return ApiResponse::success($success, "Status toggled successfully.", 200);
        } else {
            return ApiResponse::error("Failed to toggle status.", [], 404);
        }
    }

    public function destroy($id)
    {
        $post = $this->postRepository->destroy($id);
        if($post)
        {
            return ApiResponse::success($post, "Post Deleted Successfully.", 200);
        } else {
            return ApiResponse::error("Post not found.", [], 404);
        }
    }
}
