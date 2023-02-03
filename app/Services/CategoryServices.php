<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryServices
{
    protected $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function getAll() {
        return $this->categoryRepository->getAll()->toArray();
    }

    public function getAllWithColumnList($colList) {
        return $this->categoryRepository->getAllWithColumnList($colList)->toArray();
    }
}
