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
        $list_items = [];
        $book_id_list = $this->bookRepository->getListOfIds();
        if($request->has('order_items_list')) {
            $list_items = $request->only('order_items_list')['order_items_list'];
            $list_items = json_decode($list_items, true);
        }
        if(($errValidateMSG = $this->validateOrderItems($list_items, $book_id_list))!= "") {
            return ['message' => $errValidateMSG];
        }
        $order_detail = array_merge($request->except('order_items_list'), ["status" => 1]);
        $order_id = $this->orderRepository->store($order_detail)['id'];
        foreach($list_items as $offset => $item) {
            
            $list_items[$offset]["order_id"]= $order_id;
        }

        foreach($list_items as $item) {
            $update = $this->bookRepository->updateBookQuantity($item);
            if(!$update) {
                $status = 9;  //status = 9 => tạo đơn hàng không thành công
                $this->orderRepository->updateOrderStatus($order_id, $status);
                return ['message' => "Order has a product which was sold out or not enough in store! please try again !"];
            }
        }

        $save_to_order_items = $this->orderDetailRepository->store($list_items);
        
        if ($save_to_order_items) {
            return ['value' => $order_id];
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

    public function getOneOrder($order_id) {
        $order_detail = [];
        $order_infor =  $this->orderRepository->getOne($order_id)->toArray()[0];
        $order_items = $this->orderDetailRepository->getItemsByOrderId($order_id)->toArray();
        $order_detail = array_merge($order_infor, ['items' => $order_items]);
        
        return $order_detail;
    }
}
