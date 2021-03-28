<?php


namespace App\Services;


use App\Utils\RandomStringGenerator;
use Carbon\Carbon;
use function Psy\debug;

class SessionCart
{

    public $items = [];
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function getTotalAmount(){

        $items = $this->items;

        return array_reduce($items, function($i, $item)
        {
            return $i += $item['amount'];
        });

    }

    public function addToCart($item){

        $isExist = false;

        foreach ($this->items as $key => $storedItem){

            if ($storedItem['product_id'] === $item['product_id'] && $storedItem['size'] === $item['size']){

                $item['id'] = $storedItem['id'];
                $this->items[$key] = $item;
                $isExist = true;
                break;

            }

        }

        if (!$isExist){

            $random = new RandomStringGenerator();
            $item['id'] = Carbon::now()->timestamp . $random->generate(6);
            array_unshift($this->items, $item);

        }

        return $item;

    }

    public function removeCartItem($itemId){

        $index = array_search($itemId, array_column($this->items, 'id'));
        if ($index >=  0) unset($this->items[$index]);

//        foreach ($this->items as $key =>  $item){
//
//            if ($item['id'] === $itemId){
//
//                unset($this->items[$key]);
//                break;
//
//            }
//
//        }

    }


}
