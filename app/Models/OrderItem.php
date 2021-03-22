<?php

namespace App\Models;

use App\Traits\uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, uuids;

    public $fillable = ['order_id', 'product_id', 'user_id', 'product_price', 'size', 'color', 'quantity', 'product_name', 'amount' ];


    public function order(){

        return $this->belongsTo(Order::class);

    }

    public function product(){

        return $this->belongsTo(Product::class);

    }

}
