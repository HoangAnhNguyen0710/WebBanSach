<?php

namespace App\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\BookRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderServices
{
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $bookRepository;
    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
        $this->orderDetailRepository = app(OrderDetailRepository::class);
        $this->bookRepository = app(BookRepository::class);
    }

    public function store(CreateOrderRequest $request)
    {
        $itemList = [];
        $bookIdList = $this->bookRepository->getListOfIds();
        if ($request->has('order_items_list')) {
            $itemList = $request->only('order_items_list')['order_items_list'];
            $itemList = json_decode($itemList, true);
        }
        if (($errValidateMSG = $this->validateOrderItems($itemList, $bookIdList)) != "") {
            return ['message' => $errValidateMSG];
        }
        $orderDetail = array_merge($request->except('order_items_list'), ["status" => 1]);
        $orderId = $this->orderRepository->store($orderDetail)['id'];

        foreach ($itemList as $offset => $item) {

            $itemList[$offset]["order_id"] = $orderId;
        }

        foreach ($itemList as $item) {
            $update = $this->bookRepository->updateBookQuantity($item);
            if (!$update) {
                $status = 9;  //status = 9 => tạo đơn hàng không thành công
                $this->orderRepository->updateOrderStatus($orderId, $status);
                return ['message' => "Order has a product which was sold out or not enough in store! please try again !"];
            }
        }

        $saveToOrderItems = $this->orderDetailRepository->store($itemList);

        if ($saveToOrderItems) {
            return ['value' => $orderId];
        }
        return ['message' => "Save data to order items table failed"];
    }

    public function validateOrderItems($orderItems, $bookIdList)
    {
        $errMSG = "";
        foreach ($orderItems as $item) {
            if (!in_array(['id' => $item['book_id']], $bookIdList)) {
                $errMSG .= "book id: " . $item['book_id'] . " is not exist\n";
            }
        }
        return $errMSG;
    }

    public function getOne($orderId)
    {
        $orderDetail = [];
        $orderInfor =  $this->orderRepository->getOne($orderId)->toArray()[0];
        $orderItems = $this->orderDetailRepository->getItemsByOrderId($orderId)->toArray();
        $orderDetail = array_merge($orderInfor, ['items' => $orderItems]);

        return $orderDetail;
    }

    public function getOrderByUser($customerId)
    {
        $orderList =  $this->orderRepository->getOrderByCustomerId($customerId)->toArray();
        foreach ($orderList as $offset => $order) {
            $orderList[$offset]["items"] = $this->orderDetailRepository->getItemsByOrderId($orderList[$offset]['id'])->toArray();
        }
        return $orderList;
    }
}
