<?php

namespace App\Models;

use App\Traits\uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, uuids;

    protected $fillable = ['user_id', 'product_id', 'product_name',
        'product_price', 'quantity', 'size', 'color', 'amount'];

    public function product(){

        return $this->belongsTo(Product::class);

    }

    public static function getNumberOfItemsInCart()
    {
        return self::where('user_id', Auth::guard('web')->id())->sum('quantity');
    }

    public static function getGrossTotalOfItemsInCart()
    {
        return self::where('user_id', Auth::guard('web')->id())->sum('amount');
    }

    public static function getCartItems()
    {
        return self::where('user_id', Auth::guard('web')->id())->get();
    }
}
