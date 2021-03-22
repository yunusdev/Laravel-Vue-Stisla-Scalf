<?php


namespace App\Contracts;


interface OrderContract
{

    public function getOrders();

    public function getUserOrders(string $userId = null, array $relationship = []);

    public function createUserOrder(array $params);

    public function getOrderByTrackingNumber(string $tracking_number, array $relationship = []);

    public function getOrderById(string $orderId, array $relationship = []);

}
