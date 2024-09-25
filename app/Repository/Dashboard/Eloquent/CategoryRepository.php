<?php

namespace App\Repository\Dashboard\Eloquent;

use App\Models\Category;
use App\Repository\Dashboard\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
