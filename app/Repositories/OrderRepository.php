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

    public function getOne(int $orderId)
    {
        return $this->model::query()->where('id', $orderId)
            ->with('voucher')
            ->get(['id', 'status', 'price', 'discount_price', 'applied_voucher']);
    }

    public function updateOrderStatus(int $orderId, int $status)
    {
        return $this->model::query()->where('id', $orderId)
            ->update(['status' => $status]);
    }
}
