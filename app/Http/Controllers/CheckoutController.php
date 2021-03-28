<?php

namespace App\Http\Controllers;

use App\Contracts\AccountContract;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    private $accountRepository;

    public function __construct(AccountContract $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function index(){

        $data['user'] = $this->accountRepository->getUserAndAddress();
//        return $data;
        $data['paystack_pk'] = env('PAYSTACK_PUBLIC_KEY');
        return view('shop.checkout')->with($data);

    }
}
