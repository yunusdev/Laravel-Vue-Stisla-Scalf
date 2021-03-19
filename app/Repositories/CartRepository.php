<?php

namespace App\Repositories;

use App\Contracts\CartContract;
use App\Models\Cart;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartRepository extends BaseRepository implements CartContract
{
    //
    public function __construct(Cart $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getCartItems(string $orderBy = 'created_at', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $orderBy, $sort,  ['product']);
    }

    public function getUserCartItems(string $userId, array $relationship = [])
    {
        return $this->findByWhere([
            'user_id' => $userId
        ], $relationship);
    }

    public function addItemToCart(array $params)
    {
        try {

            $params['user_id'] = auth()->id();
            return Cart::updateOrCreate([
                'user_id' => $params['user_id'],
                'size' => $params['size'],
                'product_id' => $params['product_id'],
            ], $params);

        }catch (\Exception $exception){
            throw new InvalidArgumentException($exception->getMessage());
        }

    }

    public function getUserCartTotalAmount(string $userId = null)
    {
        if (!$userId) $userId = auth()->id();
        return $this->model->where('user_id', $userId)->sum('amount');

    }

    public function getCartItemBy(array $data, array $relationship = [])
    {
        return $this->findOneBy($data, $relationship);
    }

    public function getCartItemsBy(array $data, array $relationship = [])
    {
        return $this->findByWhere($data, $relationship);
    }

    public function getCartItemById(string $id, array $relationship = [])
    {
        return $this->findOneBy([
            'id' => $id
        ], $relationship);
    }

    public function updateCartItem(array $params, string $id)
    {
        // TODO: Implement updateCartItem() method.
    }

    public function clearUserCart(string $userId = null)
    {
        if (!$userId) $userId = auth()->id();
        $this->model->where('user_id', $userId)->delete();

    }

    public function removeItemFromCart($id)
    {
        return $this->delete($id);
    }

}
