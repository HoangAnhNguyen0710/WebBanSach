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

    public function getOne(int $order_id)
    {
        return $this->model::query()->where('id', $order_id)
            ->with('voucher')
            ->get(['id', 'status', 'price', 'discount_price', 'applied_voucher']);
    }
    
}