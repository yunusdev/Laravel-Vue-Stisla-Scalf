<?php


namespace App\Contracts;


use App\Models\Order;

interface OrderItemContract
{

    public function getOrderItems(string $orderId, array $relationship = []);

    public function createOrderItems(Order $order, array $orderItems);


}
