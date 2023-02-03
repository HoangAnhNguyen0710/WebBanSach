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
        foreach ($data as $row) {
            $this->model::query()->upsert($row, 'id');
        }
        return true;
    }

    public function getOne(int $book_id)
    {
        $result = $this->model->query()->with('publisher', 'category')->where('display', 1)->find($book_id);
        return $result;
    }



    public function getListOfBooksByFilter($page, $per_page, $filterCol, $filterValue, $sortCol = 'updated_at', $sortValue = 'desc')
    {

        if ((int)$filterValue > 0) {
            $filterValue = (int)$filterValue;
        }

        return $this->model->query()->select(['id', 'publisher_id', 'category_id', 'name', 'sold', 'price', 'discount_price', 'updated_at'])
            ->where($filterCol, $filterValue)
            ->where('display', 1)
            ->where($filterCol, $filterValue)
            ->orderBy($sortCol, $sortValue)
            ->with('publisher', 'category')
            ->paginate($per_page, ['*'], 'page', $page);
    }


    public function getListOfBooks($page, $per_page = null, $sortCol = 'updated_at', $sortValue = 'desc')
    {
        return $this->model->query()->select(['id', 'publisher_id', 'category_id', 'name', 'sold', 'price', 'discount_price', 'updated_at'])
            ->orderBy($sortCol, $sortValue)
            ->where('display', 1)
            ->with('publisher', 'category')
            ->paginate($per_page, ['*'], 'page', $page);
    }


    public function getListOfIds()
    {
        return $this->model->query()->get('id')->toArray();
    }
    public function searchBooksBy(string $search, $publisherSearchID)
    {
        return $this->model->query()
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orWhereIn('publisher_id', $publisherSearchID)
            ->where('display', 1)
            ->with('publisher', 'category')
            ->get(['name', 'price', 'discount_price', 'in_stock', 'sold', 'publisher_id', 'category_id']);
    }
}
