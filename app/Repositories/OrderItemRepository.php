<?php

namespace App\Repositories;

use App\Contracts\OrderItemContract;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderItemRepository extends BaseRepository implements OrderItemContract
{

    public function __construct(OrderItem $model)
    {

        parent::__construct($model);
        $this->model = $model;

    }

    public function getOrderItems(string $orderId, array $relationship = [])
    {
        return $this->model->where('order_id', $orderId)->with($relationship)->latest()->get();
    }

    public function createOrderItems(Order $order, array $orderItems)
    {
        $items = [];
        Log::debug('orderItems');
        Log::debug(json_encode($orderItems));
        foreach ($orderItems as $item){

            $item['order_id'] = $order['id'];
            $item['user_id'] = $order['user_id'];
            $orderItem = $this->create($item);
            array_push($items, $orderItem);

        }

        return $items;
    }


}
