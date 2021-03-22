<?php

namespace App\Contracts;

interface CartContract
{
    public function getCartItems(string $orderBy = 'created_at', string $sort = 'desc', array $columns = ['*']);

    public function getUserCartItems($userId, array $relationship = []);

    public function addItemToCart(array $params);

    public function getUserCartTotalAmount(string $userId = null);

    public function clearUserCart(string $userId = null);

    public function removeItemFromCart($itemId);

    public function getCartItemById(string $id, array $relationship = []);

    public function getCartItemBy(array $data, array $relationship = []);

    public function getCartItemsBy(array $data, array $relationship = []);


}
