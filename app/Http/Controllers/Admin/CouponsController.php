<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CouponContract;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponsController extends Controller
{

    protected $couponRepository;

    public function __construct(CouponContract $couponRepository)
    {

       $this->couponRepository = $couponRepository;

    }

    public function index()
    {
        $data['coupons'] = $this->couponRepository->getCoupons();
        return view('admin.coupons.index')->with($data);
    }


    public function store(Request $request)
    {

        try {

            $this->validate($request, [

                'code' => 'required|max:80|unique:coupons',
                'discount' => 'required',

            ]);

            $params = $request->only('name', 'code', 'product_id', 'type', 'discount', 'max_usage',
                'remaining', 'expires_in', 'lowest_amount', 'will_expire', 'status', 'description');
            return $this->couponRepository->storeCoupon($params);

        }catch (\Throwable $exception){

            throw $exception;

        }

    }

    public function update(Request $request, Coupon $coupon)
    {
        //
        try {

            $this->validate($request, [

                'name' => 'required|max:80',

            ]);

            $params = $request->only('name', 'code', 'product_id', 'type', 'discount', 'max_usage',
                'remaining', 'expires_in', 'lowest_amount', 'will_expire', 'status', 'description');
            $this->couponRepository->updateCoupon($params, $coupon->id);
            return $coupon->fresh();

        } catch (\Throwable $exception) {

            throw $exception;

        }
    }

    public function destroy($id)
    {
        //
        try {

            return $this->couponRepository->deleteCoupon($id);

        } catch (\Throwable $exception) {

            throw $exception;

        }
    }
}
