<?php


namespace App\Services;


class Cart
{

    public $items = null;
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

    public function addToCart($item, $selection){

        $storedItem = [
            'qty' => $selection['qty'],
            'color' => $selection['color'],
            'size' => $selection['size'],
            'product_id' => $item['id'],
        ];

    }


}
