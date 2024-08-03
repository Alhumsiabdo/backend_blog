<?php

namespace App\Http\Controllers\Dashboard\Api;

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
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        if ($category) {
            return response()->json($category);
        }

        return response()->json(['message' => 'Category not found'], 404);
    }

    public function store(StoreCategoryRequest $storeCategoryRequest)
    {
        $data = $storeCategoryRequest->validated();
        $category = $this->categoryRepository->create($data);
        return response()->json($category, 201);
    }

    public function update($id, UpdateCategoryRequest $updateCategoryRequest)
    {
        $data = $updateCategoryRequest->validated();
        $category = $this->categoryRepository->update($id, $data);
        if ($category) {
            return response()->json($category);
        }

        return response()->json(['message' => 'Category not found'], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->categoryRepository->delete($id);

        if ($deleted) {
            return response()->json(['message' => 'Category deleted']);
        }

        return response()->json(['message' => 'Category not found'], 404);
    }
}
