<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repository\Dashboard\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return ApiResponse::success($categories);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        if ($category) {
            return ApiResponse::success($category);
        }
        return ApiResponse::error("Category not found.", [], 404);
    }

    public function store(StoreCategoryRequest $storeCategoryRequest)
    {
        $data = $storeCategoryRequest->validated();
        $category = $this->categoryRepository->create($data);
        return ApiResponse::success($category, "Category Created Successfully.");
    }

    public function update($id, UpdateCategoryRequest $updateCategoryRequest)
    {
        $data = $updateCategoryRequest->validated();
        $category = $this->categoryRepository->update($id, $data);
        if ($category) {
            return ApiResponse::success($category, "Category Updated Successfully.");
        }
        return ApiResponse::error("Category not found.", [], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->categoryRepository->delete($id);

        if ($deleted) {
            return ApiResponse::success($deleted, "Category deleted successfully.", 200);
        }

        return ApiResponse::error("Category not found.", [], 404);
    }
}
