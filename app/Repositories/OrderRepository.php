<?php

namespace App\Repositories;

use App\Contracts\OrderContract;
use App\Models\Order;
use App\Utils\RandomStringGenerator;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends BaseRepository implements OrderContract
{
    //
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getOrders()
    {

    }

    public function getUserOrders(string $userId = null, array $relationship = [])
    {
        if (!$userId) $userId = auth()->id();
        return $this->findByWhere([
            'user_id' => $userId
        ], $relationship);
    }

    public function createUserOrder(array $params)
    {
        if (Auth::check()){
            $params['user_id'] = auth()->id();
        }
        $random = new RandomStringGenerator();
        $params['tracking_number'] = $random->generate(6);
        return $this->create($params);


    }

    public function getOrderByTrackingNumber(string $tracking_number, array $relationship = [])
    {
        return $this->findOneBy(['tracking_number' => $tracking_number, 'user_id' => auth()->id()], $relationship);
    }

    public function getOrderById(string $orderId, array $relationship = [])
    {

        return $this->findOneBy(['id' => $orderId], $relationship);
    }


}
