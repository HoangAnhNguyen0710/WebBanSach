<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderServices;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isType;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->orderService = app(OrderServices::class);
    }

    public function store(CreateOrderRequest $request)
    {
        $upload = $this->orderService->store($request);

        if (!empty($upload['message'])) {
            return response()->json([
                'status' => 422,
                'message' => $upload['message'],
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => ['order_id' => $upload['value']]
        ]);
    }
}
