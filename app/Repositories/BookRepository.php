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
class BookRepository extends BaseRepository {
    public function model() {
        return Book::class;
    }

    public function store($data) {
        try {
            foreach($data as $row) {
                $this->model::query()->upsert($row, 'id');
            }
            return true;
        }
        catch(\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function getOne($book_id) {
        $result = $this->model->query()->with('publisher', 'category')->where('display', 1)->find($book_id);
        return $result;
    }
}

