<?php

namespace App\Repositories;

use App\Contracts\CouponContract;
use App\Models\Coupon;

class CouponRepository extends BaseRepository implements CouponContract
{

    public function __construct(Coupon $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getCoupons()
    {
        return $this->all();
    }

    public function validateCoupon(string $code, int $totalAmount, string $userId = null)
    {
        $coupon = $this->findOneBy(['code' => $code]);

        if (!$coupon) return ['valid' => false, 'message' => 'Coupon code is not valid'];

        if (!$userId) $userId = auth()->id();

        switch ($coupon){

            case !$coupon:

                $data =  ['valid' => false, 'message' => 'Coupon code is not valid'];
                break;

            case $coupon->status === 0:

                $data =  ['valid' => false, 'message' => 'Coupon is not more Usable'];
                break;

            case $coupon->will_max_out && $coupon->remaining <= 0:

                $data =  ['valid' => false, 'message' => 'Coupon have maxed out'];
                break;

            case $coupon->users->contains($userId):

                $data =  ['valid' => false, 'message' => 'You have used this coupon before...'];
                break;

            case $coupon->lowest_amount > $totalAmount:

                $data =  ['valid' => false, 'message' => 'The lowest amount valid for this coupon is N' . $coupon->lowest_amount];
                break;

            case $coupon->will_expire === 1 && $coupon->expires_in->isPast():

                $data =  ['valid' => false, 'message' => 'Coupon has expired...'];
                break;

            default:

                $data = ['valid' => true, 'message' => 'COUPON is valid!'];
        }

        $data['coupon'] = $coupon;

        return $data;
    }

    public function getCouponBy(array $data, array $relationship = [])
    {
        return $this->findOneBy($data, $relationship);
    }

    public function getCouponsBy(array $data, array $relationship = [])
    {
        return $this->findByWhere($data, $relationship);
    }


    public function storeCoupon(array $params)
    {
        $params['admin_id'] = auth('admin')->id();
        $params['remaining'] = $params['max_usage'];
        return $this->create($params);
    }

    public function updateCoupon(array $params, string $id)
    {
        $params['remaining'] = $params['max_usage'];
        return $this->update($params, $id);
    }

    public function deleteCoupon(string $id)
    {
        return $this->delete($id);
    }


}
