<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProductRepository.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    public function getAllWithColumnList($colList)
    {
        return $this->model::query()->get($colList);
    }

    public function getAll()
    {
        return $this->model::query()->get('id');
    }

    public function getCategoryName($id) {
        return $this->model::query()->where('id', $id)->first('category_name');
    }
}
