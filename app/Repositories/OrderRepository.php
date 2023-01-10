<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProductRepository.
 *
 * @package namespace App\Repositories;
 */
class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function store($data)
    {
        return $this->model::query()->create($data)->toArray();
         
    }

   
}
