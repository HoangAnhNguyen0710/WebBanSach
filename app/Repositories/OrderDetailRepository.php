<?php

namespace App\Repositories;

use App\Models\Order_items;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProductRepository.
 *
 * @package namespace App\Repositories;
 */
class OrderDetailRepository extends BaseRepository
{
    public function model()
    {
        return Order_items::class;
    }

    public function store($data)
    {
        try {
            foreach ($data as $row) {
                $this->model::query()->create($row);
            }
            return true;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }       
    }

   
}
