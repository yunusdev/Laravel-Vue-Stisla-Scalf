<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //

    public function index(){

        $data['paystack_pk'] = env('PAYSTACK_PUBLIC_KEY');
        return view('shop.checkout')->with($data);

    }
}
