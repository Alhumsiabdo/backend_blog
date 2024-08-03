<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Repository\Dashboard\TagRepositoryInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->all();
        return ApiResponse::success($tags);
    }

    public function show($id)
    {
        $tag = $this->tagRepository->find($id);
        if ($tag) {
            return ApiResponse::success($tag);
        }
        return ApiResponse::error("Tag not found.", [], 404);
    }

    public function store(StoreTagRequest $storeTagRequest)
    {
        $data = $storeTagRequest->validated();
        $tag = $this->tagRepository->create($data);
        return ApiResponse::success($tag, "Tag Created Successfully.");
    }

    public function update($id, UpdateTagRequest $updateTagRequest)
    {
        $data = $updateTagRequest->validated();
        $tag = $this->tagRepository->update($id, $data);
        if ($tag) {
            return ApiResponse::success($tag, "Tag Updated Successfully.");
        }
        return ApiResponse::error("Tag not found.", [], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->tagRepository->delete($id);

        if ($deleted) {
            return ApiResponse::success($deleted, "Tag deleted successfully.", 200);
        }

        return ApiResponse::error("Tag not found.", [], 404);
    }
}
