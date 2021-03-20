<?php

namespace App\Http\Controllers;

use App\Contracts\CouponContract;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    private $couponRepository;

    public function __construct(CouponContract $couponRepository)
    {

        $this->couponRepository = $couponRepository;

    }

    public function validateCoupon(Request $request){

        $this->validate($request, [

            'code' => 'required',
            'total_amount' => 'required',

        ]);

        $params = $request->only('code', 'total_amount');

        $coupon_data = $this->couponRepository->validateCoupon($params['code'], $params['total_amount']);

        return response()->json([

            'coupon_data' => $coupon_data

        ]);

    }
}
