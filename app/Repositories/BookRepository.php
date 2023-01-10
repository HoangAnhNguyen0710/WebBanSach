<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProductRepository.
 *
 * @package namespace App\Repositories;
 */
class BookRepository extends BaseRepository
{
    public function model()
    {
        return Book::class;
    }

    public function store($data)
    {
        try {
            foreach ($data as $row) {
                $this->model::query()->upsert($row, 'id');
            }
            return true;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function getListOfBooksByFilter($page, $per_page, $filterCol, $filterValue)
    {

        if ((int)$filterValue > 0) {
            $filterValue = (int)$filterValue;
        }

        return $this->model->where($filterCol, $filterValue)
            ->where('display', 1)
            ->where($filterCol, $filterValue)
            ->orderBy('updated_at', 'asc')
            ->with('publisher', 'category')
            ->paginate($per_page, ['*'], 'page', $page);
    }


    public function getListOfBooks($page, $per_page = null)
    {
        return $this->model->orderBy('updated_at', 'asc')
            ->where('display', 1)
            ->with('publisher', 'category')
            ->paginate($per_page, ['*'], 'page', $page);
    }

    public function getListOfIds()
    {
        return $this->model->query()->get('id')->toArray();
    }
}
