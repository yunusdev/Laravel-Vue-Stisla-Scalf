<?php

namespace App\Repositories;

use App\Contracts\CartContract;
use App\Models\Cart;
use App\Services\SessionCart;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartRepository extends BaseRepository implements CartContract
{
    //

    public function __construct(Cart $model)
    {
        parent::__construct($model);
        $this->model = $model;

    }


    public function getCartSession(){

        return Session::has('cart') ? Session::get('cart') : null;

    }

    public function getCartItems(string $orderBy = 'created_at', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $orderBy, $sort,  ['product']);
    }

    public function getUserCartItems($userId, array $relationship = [])
    {
        if (Auth::check()){

            return $this->findByWhere([
                'user_id' => $userId
            ], $relationship);

        }

        $cart = new SessionCart($this->getCartSession());
        return $cart->items;

    }

    public function addItemToCart(array $params)
    {
        try {
            if (Auth::check()){
                $params['user_id'] = auth()->id();
                return Cart::updateOrCreate([
                    'user_id' => $params['user_id'],
                    'size' => $params['size'],
                    'product_id' => $params['product_id'],
                ], $params);

            }

            $cart = new SessionCart($this->getCartSession());
            $item = $cart->addToCart($params);
            Session::put('cart', $cart);
            return $item;

        }catch (\Exception $exception){
            throw new InvalidArgumentException($exception->getMessage());
        }

    }

    public function getUserCartTotalAmount(string $userId = null)
    {
        if (Auth::check()){
            if (!$userId) $userId = auth()->id();
            return $this->model->where('user_id', $userId)->sum('amount');
        }

        $cart = new SessionCart($this->getCartSession());
        return $cart->getTotalAmount();


    }

    public function clearUserCart(string $userId = null)
    {
        if (Auth::check()){
            if (!$userId) $userId = auth()->id();
            $this->model->where('user_id', $userId)->delete();
            return;
        }
        Session::put('cart', null);

    }

    public function removeItemFromCart($itemId)
    {
        if (Auth::check()) {
            return $this->delete($itemId);
        }
        $cart = new SessionCart($this->getCartSession());
        $cart->removeCartItem($itemId);
        Session::put('cart', $cart);

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




}
